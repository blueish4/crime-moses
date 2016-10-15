import geocoder

import googlemaps
import json
import re
import time
from collections import OrderedDict
from googlemaps import Client

gmaps = Client("AIzaSyAKn5itEtU3TzRJnIlOTtMgsKCjAOcUAFI") #key to access google API


def zipcode_route(address, destination,transport):
    directions = gmaps.directions(address, destination,  mode=transport) #Get the step by step directions for the route from affrss to destination

    directions_list=[]

    for step in directions[0]['legs'][0]['steps']:
        directions_list.append(step['start_location'])  #Ignore all data except for latitude and longitude of each step

    place = []

    for j in range(len(directions_list)-1):
        place.append(str(geocoder.google(directions_list[j], method='reverse')))  # Get the full address of each step
        time.sleep(1) # Has to sleep in order to give geoccode time to translate point

    for k in range(len(place)):
        place[k] = place[k][-15:-7] # Removes everything except for the postcode

    final = []

    for i in range(len(place)-1):
        if place[i]!= place[i+1]:  #Only add one of every postcode
            final.append(place[i])

    final.append(place[len(place)-1]) #Add final postcode that is missed out by the above loop

    return final



print(zipcode_route('Douglas Park, Chicago, IL, USA', '10000 W O\'Hare Ave, Chicago, IL , United States ','walking'))

