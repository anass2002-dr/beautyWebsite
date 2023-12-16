from selenium import webdriver
from selenium.webdriver.chrome.service import Service as ChromeService
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
cats=[
    'body_care_products',
    'beauty_sports',
    'hair_care_products',
    'face_care',
    'cosmetics_products',
    'beauty_devices'
]
for i in range(1,len(cats)):
    print(cats[i])
    