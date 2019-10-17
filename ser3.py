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
			text = bytes('\x02'+x+'\x03', 'utf-8')
				
	#print str(baud)+ ' '+port+' '+text
	ser = serial.Serial()
	ser.timeout = 1
	ser.baudrate = baud
	ser.port = port
	try: 
		ser.open()
	except Exception as e:
		print("error open serial port: ", str(e))
		exit()
	#ser.open()
	if(text!=''):
		ser.write_timeout=1
		ser.write(text)
		ser.flush()
		time.sleep(0.01)
	res = ser.readline()
	#print(type(text))
	#print(text)
	print(str(res))
	ser.close()
getser()