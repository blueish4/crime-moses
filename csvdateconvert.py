import csv
from datetime import datetime

incsvloc = "/home/michael/Documents/ChicagoCrimeDataAll.csv"
outcsvloc = "/home/michael/Documents/ChicagoCrimeDataAll.tidy.csv"
with open(incsvloc) as incsv:
    reader = csv.DictReader(incsv)
    with open(outcsvloc, "w") as outcsv:
        # Write header row
        outcsv.write("ID,Case Number,Date,Block,IUCR,Primary Type,Description,Location Description,Arrest,Domestic,"
                     "Beat,District,Ward,Community Area,FBI Code,Year,Updated On,Latitude,Longitude,Location")
    with open(outcsvloc, "a") as outcsv:
        for row in reader:
            obj = {}
            writer = csv.DictWriter(outcsv, fieldnames=["ID", "Case Number", "Date", "Block", "IUCR", "Primary Type",
                                                        "Description", "Location Description", "Arrest", "Domestic",
                                                        "Beat", "District", "Ward", "Community Area", "FBI Code",
                                                        "Year", "Updated On", "Latitude", "Longitude", "Location"],
                                    lineterminator='\n')
            for key in row:
                if key == "X Coordinate" or key == "Y Coordinate":
                    continue
                elif key == "Date":
                    #date_object = datetime.strptime('Jun 1 2005  1:33PM', '%b %d %Y %I:%M%p')
                    #  11/23/2015 02:10:00 PM
                    obj["Date"] = datetime.strptime(row[key], '%m/%d/%Y %I:%M:%S %p').timestamp()
                    print(obj["Date"])
                else:
                    obj[key] = row[key]
            writer.writerow(obj)
