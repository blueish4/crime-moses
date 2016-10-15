import csv
import MySQLdb as sql

# you will need to install sql server on your machine and create the schema and user
db = sql.connect(host="127.0.0.1", user="python", passwd="python", db="crime-moses", charset="utf8", use_unicode=True)
cur = db.cursor()
cur.execute("DROP TABLE IF EXISTS crimes")  ## JUST TESTING ONLY. REMOVE LATER
cur.execute("CREATE TABLE crimes( `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, <OTHER COLUMNS HERE> CHARACTER SET utf8 COLLATE utf8_general_ci")
# The ab=ove line would be the query to create the database replace <other columns here>, obvs

with open('/home/michael/Documents/ChicagoCrimeData_sample.csv') as csvfile:
    reader = csv.DictReader(csvfile)
    for row in reader:
        # This will itterate through each row in the file, refer to as dictionary with the headers as keys
        # ID,Case Number,Date,Block,IUCR,Primary Type,Description,Location Description,Arrest,Domestic,Beat,District,Ward,Community Area,FBI Code,X Coordinate,Y Coordinate,Year,Updated On,Latitude,Longitude,Location
        pass

db.commit() # Remember this to actually push it to a db
