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

def isDataURL(s) :
    return re.search(regex, s, re.IGNORECASE)

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
    if isDataURL(d['_logo']) :
        t, data = getData(d['_logo'])
        ext = t.split('/')[-1]
        fn = 'temp.' + ext
        with open(fn, 'wb') as f:
            f.write(data)
    else:  
        r = requests.get(d['_logo'], stream=True, headers={'User-agent': 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1941.0 Safari/537.36'})
        if (r.status_code == 200) or (r.status_code == 304 ):
            #ext=d['_logo'].split('/')[-1].split('.')[-1]
            ext=r.headers['content-type'].split('/')[-1]
            #ext = imghdr.what(None, h=r.raw)

            tmp="" 
            with tempfile.NamedTemporaryFile(suffix='.' + ext, delete=False) as t :
                tmp = t.name
                for chunk in r:
                    t.write(chunk)
            
            with Image.open(tmp) as img :
                img.save(   OUTPUT + '/' + d['logo'])

            os.unlink(tmp)

            print ("\t\tSaved to :" + OUTPUT + '/' + d['logo'])
            success_count += 1
        else :
            failed.append(d)
            print ("\t\tFailed : " + str(r.status_code))

print("")
print("Success : " + str(success_count ) + "/" + str(count))
print("Failed : " + str(len(failed)) + "/" + str(count))

for d in failed :
    print ("\t" + d['_id'] + "\t" + d['name'] + "\t" + d['_logo'])

