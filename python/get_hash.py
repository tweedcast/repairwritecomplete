import hashlib
import hmac
import base64

# my and key as per question
my = "https://parts.claimresolution.net/api/repair/bms-import/estimate?appId=694&trigger=manual<VehicleDamageEstimateAddRq xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' xmlns='http://www.cieca.com/BMS'><RqUID>937c485d-5d89-4936-8b1d-7e87c8"
key = "yF292aNgwprLy1b9lHfZSFaRm0mLAlXTxceSh9ILdkCYhUg1p6AXKYq81xh2liD"

# encoding as per other answers
byte_key = key.encode()  # key.encode() would also work in this case
message = my.encode()

# now use the hmac.new function and the hexdigest method
h = hmac.new(byte_key, message, hashlib.sha1).digest()

# print the output
print(base64.b64encode(h))
