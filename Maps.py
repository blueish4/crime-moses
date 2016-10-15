import googlemaps
import json

from googlemaps import Client
gmaps = Client("AIzaSyAKn5itEtU3TzRJnIlOTtMgsKCjAOcUAFI")

address = 'Constitution Ave NW & 10th St NW, Washington, DC'
destination = '1 First St NE, Washington, DC 20543, United States'

directions = gmaps.directions(address, destination)

for step in directions[0]['legs'][0]['steps']:
    print(step['html_instructions'])







#print(json.dumps(directions, indent = 2))


#for step in directions:
   #pass

#distances = gmaps.distance_matrix(address, destination)

#print(distances)

#print(step['legs'])







