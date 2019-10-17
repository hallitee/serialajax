import sys, serial, io, time, locale
ser = serial.Serial()
#print(len(sys.argv))
baud = 115200
port = 'COM1'
text = '\2PP\3'
arr=['','\x02GT\x03','\x02ET\x03','\x02PP\x03']
locale.getpreferredencoding()
text = text.encode()
res = ''
z=0
for x in sys.argv:
	if(sys.argv.index(x)==1):
		baud = int(x)
	elif(sys.argv.index(x)==2):
		port = str(x)
	elif(sys.argv.index(x)==3):
		text = bytes('\x02'+x+'\x03', 'ascii')
		print(type(x))
		#text = bytes(x.encode('cp1252'))
		#print(text)
		#text = x.encode("ascii").decode('unicode_escape')
		#x=str(x).decode('unicode_escape')
		#z = arr.index(x)		
		#print str(baud)+ ' '+port+' '+text

ser.timeout = 1
ser.baudrate = baud
ser.port = port
ser.open()
#if(z!=0):
if(text!=''):
	ser.write_timeout=1
	ser.write(text)
	ser.flush()
	time.sleep(0.01)
res = ser.readline()
print(type(text))
print(text)
print(res)
ser.close()