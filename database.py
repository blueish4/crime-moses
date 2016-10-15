#Main database

#Input: Location, Datetime, Route, Crimes

import MySQLdb, sys
from sshtunnel import SSHTunnelForwarder

with SSHTunnelForwarder(ssh_address_or_host=("138.68.141.107", 22), ssh_password="django-m0ses", ssh_username="root", remote_bind_address=("localhost", 3306)) as server:
    #try:
        connection = MySQLdb.connect(host="localhost", port=3306, user="python", passwd="python", db="crimemoses")

        cur = connection.cursor()
        cur.execute("SELECT VERSION()")

        ver = cur.fetchone()

        print("Database version : %s " % ver)

    #except:

    #    print("There was an error")






    #finally:

        if connection:
             connection.close()