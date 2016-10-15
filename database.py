#Main database

#Input: Location, Datetime, Route, Crimes

import MySQLdb, sys
from sshtunnel import SSHTunnelForwarder

with SSHTunnelForwarder(ssh_address_or_host=("138.68.141.107", 22), ssh_password="django-m0ses", ssh_username="root",
                        remote_bind_address=("localhost", 3306)) as server:
    connection = MySQLdb.connect(host="127.0.0.1", port=server.local_bind_port, user="python", passwd="python", db="crimemoses")

    cur = connection.cursor()
    cur.execute("SELECT VERSION()")

    ver = cur.fetchone()

    print("Database version : %s " % ver)