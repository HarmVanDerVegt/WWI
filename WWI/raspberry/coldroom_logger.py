# !!! de host staat nu op localhost 

import mysql.connector
import time
from datetime import datetime
from datetime import timedelta
from sense_hat import SenseHat

# voor ingestelde variablen
sensor_id = 1
interval = 2

# sensor klaar maken voor gebruik
sensor = SenseHat()

# sql codes
oud_tempratuur = "SELECT * FROM coldroomtemperatures WHERE ColdRoomSensorNumber=%s" % sensor_id
naar_archief = "INSERT INTO coldroomtemperatures_archive VALUES (%s,%s,'%s',%s,'%s','%s')"
update_tempratuur = """
UPDATE coldroomtemperatures
SET ColdRoomTemperatureID=ColdRoomTemperatureID+4, RecordedWhen='%s', Temperature=%s, ValidFrom='%s', ValidTo='%s'
WHERE ColdRoomSensorNumber=%s"""

# connecten met database
print("connectie met database maken"); # verander host
mydb = mysql.connector.connect(
	host="localhost",
	user="root",
	database="wideworldimporters")

mycursor = mydb.cursor()

while 1:
	# tempratuur gegevens van sensor verzamelen
	print("===================tempratuur gegevens van sensor verzamelen")
	temp = sensor.get_temperature()
	print(temp)
	
	# bepaal huidige datum en tijd
	huidige_tijd = datetime.now()
	str_tijd = huidige_tijd.strftime('%Y-%m-%d %H:%M:%S')
	toekomst = huidige_tijd+timedelta(seconds=interval)
	
	# database bewerken
	print("====================database berwerkingen================================")
	#haal de oude tempratuur gegevens op
	print("--------------haal de oude tempratuur gegevens op")
	mycursor.execute(oud_tempratuur)
	ColdRoomTemperatureID,ColdRoomSensorNumber,RecordedWhen,Temperature,ValidFrom,ValidTo = mycursor.fetchone()
	print(ColdRoomTemperatureID,ColdRoomSensorNumber,RecordedWhen,Temperature,ValidFrom,ValidTo)
	
	#sla oude tempratuur gegevens op in archief tabel
	print("--------------sla oude tempratuur gegevens op in archief tabel")
	mycursor.execute(naar_archief % (ColdRoomTemperatureID,ColdRoomSensorNumber,RecordedWhen,Temperature,ValidFrom,ValidTo))
	mydb.commit()
	print(naar_archief % (ColdRoomTemperatureID,ColdRoomSensorNumber,RecordedWhen,Temperature,ValidFrom,ValidTo))
	
	#sla nieuwe tempratuur gegevens op
	print("--------------sla nieuwe tempratuur gegevens op")
	mycursor.execute(update_tempratuur % (str_tijd,temp,str_tijd,toekomst.strftime('%Y-%m-%d %H:%M:%S'),sensor_id))
	mydb.commit()
	print(update_tempratuur % (str_tijd,temp,str_tijd,toekomst.strftime('%Y-%m-%d %H:%M:%S'),sensor_id))
	
	# wacht voor volgende meting
	print("-----------------------------wacht %s seconden ---------------------------------------------" % interval)
	time.sleep(interval) # in seconden
