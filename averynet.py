import socket
import sys
#print(len(sys.argv))
ipaddress = '88.200.125.216'
port = 3002
text = b'\2\3'
#text = text.encode()
res = ''
for x in sys.argv:
	if(sys.argv.index(x)==1):
		ipaddress = str(x)
	elif(sys.argv.index(x)==2):
		port = int(x)
	elif(sys.argv.index(x)==3):
		#print(type(x))
		text = '\x02'+x+'\x03'
		text=text.encode()
# Create a TCP/IP socket
sock = socket.socket(socket.AF_INET, socket.SOCK_STREAM)

# Connect the socket to the port where the server is listening
server_address = ('88.200.125.216', 3002)
#print('connecting to %s port %s' % server_address)
try:
	sock.settimeout(2)
	sock.connect(server_address)
	
except Exception as e:
		print("error opening ethernet port: ", str(e))
		exit()
try:    
    # Send data
	#message = text
	#print('sending "%s"' % str(text))
	sock.sendall(text)

    # Look for the response
	amount_received = 0
	amount_expected = 2#len(message)
    
	#while amount_received < amount_expected:
	data = sock.recv(100)
	amount_received += len(data)
	print(str(data))

finally:
	#print('closing socket')
	sock.close()