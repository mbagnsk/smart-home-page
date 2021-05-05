import paho.mqtt.client as mqtt
import sys

topic = sys.argv[1]

def on_connect(client, userdata, flags, rc):
    print("Connected with result code: " + str(rc))
    client.subscribe(topic)

def on_message(client, userdata, msg):
    print(msg.payload.decode())

client = mqtt.Client()
client.connect("127.0.0.1", 1883, 60)

client.on_connect = on_connect
client.on_message = on_message

client.loop_forever()