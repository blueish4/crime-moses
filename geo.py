import geocoder

import googlemaps
import json
import re

from googlemaps import Client
gmaps = Client("AIzaSyAKn5itEtU3TzRJnIlOTtMgsKCjAOcUAFI")

address = 'Douglas Park, Chicago, IL, USA'
destination = '10000 W O\'Hare Ave, Chicago, IL , United States '

directions_list = []
places = []

directions = gmaps.directions(address, destination,  mode='walking')

print(directions)

for step in directions[0]['legs'][0]['steps']:
    #print(step['start_location'])
    directions_list.append(step['start_location'])

print(directions_list[0])
print()
print(directions_list[5])

place = []

for j in range(len(directions_list)-1):
    place.append(str(geocoder.google(directions_list[j], method='reverse')))

print(place)
for k in range(len(place)-1):
    place[k] = place[k][-15:-7]

print(place)
