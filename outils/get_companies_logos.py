import os
import json
import requests
import shutil
import re
import imghdr
import base64
import tempfile
from PIL import Image

FILENAME="companies.json"
OUTPUT="../public/uploads/logos"

regex = r"^\s*data:([a-z]+\/[a-z]+(;[a-z\-]+\=[a-z\-]+)?)?(;base64)?,([a-z0-9\!\$\&\'\,\(\)\*\+\,\;\=\-\.\_\~\:\@\/\?\%\s]*\s*)$"

# Detect if a url is actual a base64 image
def isDataURL(s) :
    return re.search(regex, s, re.IGNORECASE)

# Extract the file type and data from a base64 link
def getData(s) :
    m = re.search(regex, s, re.IGNORECASE)
    return (m.group(1), base64.b64decode(m.group(4)))


print ("#######################################################################")
print ("#                   Company logo download script                      #")
print ("# ------------------------------------------------------------------- #")
print ("# Version : 1.0 ")
print ("# Requirements : " + FILENAME + "  (from get_companies_json.html)")
print ("# Output : " + OUTPUT + "/")
print ("#######################################################################")
print ("")

if not os.path.exists(FILENAME) :
    print ("ERROR : ")
    print ("  Please create a '" + FILENAME + "' using the get_companies_json.html tool")
    exit()


if input("This script will download logos and put them in " + OUTPUT +  ", do you wish to continue? (y/n)") != "y":
    exit()

print ("Opening " + FILENAME + "...")
with open(FILENAME) as json_file:
    data = json.load(json_file)


print ("")
print ("Starting download ...")
print ("")

failed=[]
success_count = 0
count=0

for d in data :
    count += 1
    print ("\t" + d['_id'] + "\t" + d['name'] + "\t" + d['_logo'])

    # Save our file to temporary location so we can transform it
    #   todo : find a neater way todo this without saving a file... 
    tmp_img_name=""
    img_data=bytearray()

    # Process link
    if isDataURL(d['_logo']) :
        # Is a base64 url, no need to do a GET, we already have the data
        t, img_data = getData(d['_logo'])
        ext = t.split('/')[-1]

    else:  
        # Is a regular URL, lets do a GET request
        r = requests.get(d['_logo'], stream=True, 
            # Pretend to be a real browser and not a robot
            headers={'User-agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1941.0 Safari/537.36'})
        
        # Handle rejection like a gentleman..
        if (r.status_code != 200) and (r.status_code != 304 ):
            failed.append(d)
            print ("\t\tFailed : " + str(r.status_code))
            continue

        # Extract file type from header information
        ext=r.headers['content-type'].split('/')[-1]
        for chunk in r:
            img_data += chunk

    # Save our file to temporary location so we can transform it
    with tempfile.NamedTemporaryFile(suffix='.' + ext, delete=False) as t :
        tmp_img_name = t.name
        t.write(img_data)
    
    # create the new file in the format specified in the json file
    with Image.open(tmp_img_name) as img :
        img.save(   OUTPUT + '/' + d['logo'])

    # delete the temporary file
    os.unlink(tmp_img_name)

    print ("\t\tSaved to :" + OUTPUT + '/' + d['logo'])
    success_count += 1

print("")
print("Summary : ")
print("\tSuccess : " + str(success_count ) + "/" + str(count))
print("\tFailed : " + str(len(failed)) + "/" + str(count))
for d in failed :
    print ("\t\t" + d['_id'] + "\t" + d['name'] + "\t" + d['_logo'])

