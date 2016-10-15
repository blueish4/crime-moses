#Main database

#Input: Location, Datetime, Route, Crimes

import MySQLdb, sys
from sshtunnel import SSHTunnelForwarder
import csv

with SSHTunnelForwarder(ssh_address_or_host=("138.68.141.107", 22), ssh_password="django-m0ses", ssh_username="root",
                        remote_bind_address=("localhost", 3306)) as server:
    connection = MySQLdb.connect(host="127.0.0.1", port=server.local_bind_port, user="python", passwd="python", db="crimemoses")
    cur = connection.cursor()
    with open('/home/michael/Documents/ChicagoCrimeData_sample.csv') as csvfile:
        reader = csv.DictReader(csvfile)
        for row in reader:
            # This will itterate through each row in the file, refer to as dictionary with the headers as keys
            # ID,Case Number,Date,Block,IUCR,Primary Type,Description,Location Description,Arrest,Domestic,Beat,District,
            # Ward,Community Area,FBI Code,X Coordinate,Y Coordinate,Year,Updated On,Latitude,Longitude,Location
            try:
                cur.execute("INSERT INTO locations(IUCR, longitude, latitude, date) VALUES (%s, %s, %s, STR_TO_DATE(%s, %s));",
                        (row["IUCR"], row["Longitude"], row["Latitude"], row["Date"], "%m/%d/%Y %h:%i"))
                connection.commit()
            except KeyboardInterrupt:
                pass
    cur.execute("SELECT * FROM locations")
    print(cur.fetchall())
    connection.commit()
    cur.close()
    server.close()
    sys.exit(0)