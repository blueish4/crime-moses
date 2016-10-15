#Main database



#Input: Location, Datetime, Route, Crimes

import MySQLdb, sys
from sshtunnel import SSHTunnelForwarder

print("fuck1")

with SSHTunnelForwarder(ssh_address_or_host=("138.68.141.107", 22), ssh_password="django-m0ses", ssh_username="root",
                        remote_bind_address=("localhost", 3306)) as server:
    print("fuck2")
    connection = MySQLdb.connect(host="localhost", port=server.local_bind_port, user="python", passwd="python", db="crimemoses")

#connection = MySQLdb.connect(host="138.68.141.107", port=3306, user="python", passwd="python",db="crimemoses")

cur = connection.cursor()
cur.execute("SELECT VERSION()")

ver = cur.fetchone()

print("Database version : %s " % ver)
print("fuck")