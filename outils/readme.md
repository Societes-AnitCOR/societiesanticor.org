# Outils / Tools

## Outils d'export du Google Sheets

La base des données de depart (avant la mise en service du site) existe dans un google sheet : https://docs.google.com/spreadsheets/d/1yCxNTeeG1py5qqTf2cHgZbk4njSPtzhc5XaTt3LB510

Les outils get_companies* sont faits pour travailler avec ces informations

| Tool                      | Purpose                                                |
| ------------------------- | ------------------------------------------------------ |
| `get_companies_json.html` | Convertir le google sheet en JSON                      |
| `get_companies_logos.py`  | Télécharger des logos en utilisant un fichier .json    |
| `get_companies_sql.htm`   | Créer un script de migration SQL                       |
| `get_companies.htm`       | Prévisualisation des informations                      |


## Use the scripts to create a demo data base

1. Import the contents of the google sheet into the local database 
    1. Open `get_companies_sql.htm` and copy the generated SQL
    2. Execute this SQL in a MYSQL console / tool

2. Download the logos
    1. Get the data in JSON format using `get_companies_json.html` and save it as the file `outils/companies.json`
    2. From `outils/` run `python get_companies_logos.py`



