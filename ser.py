import sys, serial, io, time
#def getser():
	#print(len(sys.argv))
	baud = 115200
	port = 'COM1'
	text = ""
	for x in sys.argv:
		if(sys.argv.index(x)==1):
			baud = int(x)
		elif(sys.argv.index(x)==2):
			port = str(x)
		elif(sys.argv.index(x)==3):
			text = str(x)	
				
	#print str(baud)+ ' '+port+' '+text
	ser = serial.Serial()
	ser.timeout = 2
	ser.baudrate = baud
	ser.port = port
	ser.open()
	if(text!=''):
		ser.write_timeout=2
		#print text
		ser.write(text.encode())
		ser.flush()
		time.usleep(0.1)
	text = ser.readline()
	print text
	ser.close()
#getser()