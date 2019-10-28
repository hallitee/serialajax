#https://stackoverflow.com/questions/56844170/how-to-read-serial-port-with-php
import sys, serial, io, time
def getser():
	#print(len(sys.argv))
	baud = 115200
	port = 'COM1'
	text = b'\2PP\3'
	#text = text.encode()
	res = ''
	for x in sys.argv:
		if(sys.argv.index(x)==1):
			baud = int(x)
		elif(sys.argv.index(x)==2):
			port = str(x)
		elif(sys.argv.index(x)==3):
			#print(type(x))
			text = bytes('\2'+x+'\3')
				
	#print str(baud)+ ' '+port+' '+text
	ser = serial.Serial()
	ser.timeout = 3
	ser.baudrate = baud
	ser.port = port
	ser.open()
	if(text!=''):
		ser.write_timeout=1
		ser.write(text)
		ser.flush()
		time.sleep(1)
	res = ser.read(100)
	#print(type(text))
	#print(text)
	print(str(res))
	ser.close()
getser()