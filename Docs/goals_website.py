import schedule
import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import csv
import json
import requests
import os
path="C:\\Program Files (x86)\\chromedriver.exe"
driver=webdriver.Chrome()

# url='https://www.goal.com/en/tables'

with open('Docs\\tables_links.csv', mode='r') as tables_links:
    # tab_links=csv.reader(tables_links,delimiter=',')
    tables_list=[]
    for tab in tables_links:
        tables_list.append(tab)
    
    for t in range(0,5):
        url=tables_list[t].strip()
        driver.get(url) 
        title=driver.find_element(By.CLASS_NAME,'header_title__k8WIS')
        print(title.text)
