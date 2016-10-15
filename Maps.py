import googlemaps
import json
import re

from googlemaps import Client
gmaps = Client("AIzaSyAKn5itEtU3TzRJnIlOTtMgsKCjAOcUAFI")

address = 'Douglas Park, Chicago, IL, USA'
destination = '10000 W O\'Hare Ave, Chicago, IL 60666, United States '

directions_list = []
places = []

directions = gmaps.directions(address, destination)

for step in directions[0]['legs'][0]['steps']:
    print(step['html_instructions'])
    directions_list.append(step['html_instructions'])

for i in range(len(directions_list)-1):
    #print(directions_list[i])
    places.append(re.sub('<b>(.+?)</b>', '', directions_list[i]))
    #try:
        #places.append(re.search('<b>(.+?)<', directions_list[i]).group(1))

    #except AttributeError:
        #print(directions_list[i])


print(places)










