import sys, serial, io, time
def avery():
	return "AVERY INDICATOR"
def bilanciai():
	return "BILANCIAI INDICATOR"
def toledo():
	return "METTLER TOLEDO INDICATOR"
def getser():
	#print(len(sys.argv))
	baud = 9600
	port = 'COM3'
	text = b'XB\D'
	cmd = ''
	device = ""
	#text = text.encode()
	res = ''
	for x in sys.argv:
		if(sys.argv.index(x)==1):
			baud = int(x)
		elif(sys.argv.index(x)==2):
			port = str(x)
		elif(sys.argv.index(x)==3):
			#print(type(x))
			text = bytes(x+'\x0D\x0A', 'utf-8')
		elif(sys.argv.index(x)==4):
			device = x	
	if(not device):
		device="AVERYTRONICS"
	switcher = {
		"AVERY": avery,
		"BILANCIAI": bilanciai,
		"TOLEDO": toledo		
	}
		
	
	#print str(baud)+ ' '+port+' '+text
	ser = serial.Serial()
	ser.timeout = 2
	ser.baudrate = baud
	ser.port = port
	try: 
		ser.open()
	except Exception as e:
		print("error open serial port: ", str(e))
		exit()
	#ser.open()
	if(text!=''):
		ser.write_timeout=2
		ser.write(text)
		ser.flush()
		time.sleep(0.01)
	res = ser.readline()
	gstr = switcher.get(device, lambda: "Invalid device")
	print(gstr())
	#print(type(text))
	#print(text)	
	ser.close()
	#print(str(res))
getser()