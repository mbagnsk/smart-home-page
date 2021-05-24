import paho.mqtt.client as mqtt
import sys
import mysql.connector
import datetime
import random

mydb = mysql.connector.connect(
    host = "localhost",
    user = "root",
    passwd = "password",
    database = "projekt_zespolowy",
)

topic = sys.argv[1]

def on_connect(client, userdata, flags, rc):
    print("Connected with result code: " + str(rc))
    client.subscribe(topic)

def on_message(client, userdata, msg):
    received = msg.payload.decode().split(",")
    if received[0] == "temperature":
        id_device = int(received[1])
        id_channel = int(received[2])
        measurement_datetime = measurement_time_datetime = datetime.datetime.strptime(received[3], "%Y-%m-%d %H:%M:%S")
        measurement = received[4]
        measurement_units = received[6]
        measurement_type = received[5]

        my_cursor = mydb.cursor()
        sqlQuery = "INSERT INTO measurements (datetime, timezone, id_device, id_channel, measurement, measurement_units, measurement_type) VALUES (%s, %s, %s, %s, %s, %s, %s)"
        record = (measurement_datetime, 0, id_device, id_channel, measurement, measurement_units, measurement_type)

        my_cursor.execute(sqlQuery, record)
        mydb.commit()

        print("New record added / temperature")

    if received[0] == "alarm":
        id_device = int(received[1])
        id_channel = int(received[2])
        measurement_datetime = measurement_time_datetime = datetime.datetime.strptime(received[3], "%Y-%m-%d %H:%M:%S")
        measurement = received[4]
        measurement_type = received[5]

        my_cursor = mydb.cursor()
        sqlQuery = "INSERT INTO measurements (datetime, timezone, id_device, id_channel, measurement, measurement_type) VALUES (%s, %s, %s, %s, %s, %s)"
        record = (measurement_datetime, 0, id_device, id_channel, measurement, measurement_type)

        my_cursor.execute(sqlQuery, record)
        mydb.commit()

        print("New record added / alarm")

    if received[0] == "lighting":
        id_device = int(received[1])
        id_channel = int(received[2])
        measurement_datetime = measurement_time_datetime = datetime.datetime.strptime(received[3], "%Y-%m-%d %H:%M:%S")
        measurement = received[4]
        measurement_type = received[5]

        my_cursor = mydb.cursor()
        sqlQuery = "INSERT INTO measurements (datetime, timezone, id_device, id_channel, measurement, measurement_type) VALUES (%s, %s, %s, %s, %s, %s)"
        record = (measurement_datetime, 0, id_device, id_channel, measurement, measurement_type)

        my_cursor.execute(sqlQuery, record)
        mydb.commit()

        print("New record added / lighting")

    if received[0] == "test_esp":
        print(received)

client = mqtt.Client()
client.connect("127.0.0.1", 1883, 60)

client.on_connect = on_connect
client.on_message = on_message

client.loop_forever()