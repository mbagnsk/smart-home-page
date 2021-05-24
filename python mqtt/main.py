import mysql.connector
import datetime
import random

mydb = mysql.connector.connect(
    host = "localhost",
    user = "root",
    passwd = "password",
    database = "projekt_zespolowy",
)

today = datetime.datetime.now()

measurement_time_string = datetime.datetime.now(datetime.timezone.utc).strftime("%Y-%m-%d %H:%M:%S")

measurement_time_datetime = datetime.datetime.strptime(measurement_time_string, "%Y-%m-%d %H:%M:%S")
measurement_time_datetime_ms = random.randint(0, 1000)

my_cursor = mydb.cursor()

sqlStuff = "INSERT INTO measurements (datetime, timezone, id_device, id_channel, measurement, measurement_type) " \
           "VALUES (%s, %s, %s, %s, %s, %s)"
record_temperature = (measurement_time_datetime, 0, 1, 1, 30, 'C', 'temperature')
record_alarm = (measurement_time_datetime, 0, 2, 1, 1, 'alarm')
record_lighting = (measurement_time_datetime, 0, 3, 1, 1, 'lighting')

my_cursor.execute(sqlStuff, record_alarm)
mydb.commit()
