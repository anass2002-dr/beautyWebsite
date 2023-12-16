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
import re

# import pandas as pd
# import requests
# from bs4 import BeautifulSoup


# def get_data(product_link, px_list=None):
#     """Get product information"""
#     data_dic = {'pd_id': [], 'size_and_item': [], 'category': [],
#                 'price': [], 'love_count': [], 'reviews_count': []}
#     px_idx = 0
#     proxy = None if px_list is None else px_list[px_idx]

#     while True:
#         try:
#             response = requests.get(product_link, proxies={
#                 "http": proxy, "https": proxy}, timeout=15)
#         except:
#             if px_idx == len(px_list) - 1:
#                 px_idx = 0
#             else:
#                 px_idx += 1
#             proxy = px_list[px_idx]
#             continue

#         html = response.text
#         soup = BeautifulSoup(html, 'html.parser')
#         data_dic['pd_id'] = re.findall(R'P[0-9]{3,6}', product_link)[0]

#         # Get Category
#         try:
#             cat_box = soup.find_all(attrs={'data-comp': 'BreadCrumbs '})[0]
#             cat_list = [cat.string for cat in cat_box.find_all('a')]
#             category = ', '.join(cat_list)
#         except:
#             category = None

#         # Size and Content
#         try:
#             size_and_item = soup.find(
#                 attrs={"data-comp": "SizeAndItemNumber Box "}).get_text()
#         except:
#             size_and_item = None

#         # Get Price
#         try:
#             price = soup.find_all(attrs={'data-comp': 'Price Box '})[
#                 0].get_text()
#         except:
#             price = None

#         # Get love counts
#         try:
#             love_count = soup.find('span', attrs={
#                 "data-at": "product_love_count"}).get_text()
#         except:
#             love_count = None

#         # review nums
#         try:
#             link_json = soup.find(attrs={"id": "linkJSON"})
#             json_str = str(link_json)
#             reviews = re.findall(R'\"reviews\":(.*?)\,', json_str)
#             reviews_count = reviews[0]
#         except:
#             reviews_count = None

#         data_dic['category'] = category
#         data_dic['size_and_item'] = size_and_item
#         data_dic['love_count'] = love_count
#         data_dic['reviews_count'] = reviews_count
#         data_dic['price'] = price
#         break
#     return data_dic


# px_list_ = ['140.227.173.230:1000', '140.227.224.177:1000',
#             '140.227.225.38:1000', '140.227.237.154:1000',
#             '40.227.174.216:1000', '140.227.175.225:1000',
#             '140.227.229.208:3128', '155.138.135.199:8080',
#             '149.28.54.243:8080', '64.188.3.162:3128',
#             '165.22.211.212:3128']

# # pd_links_df = pd.read_csv('data/product_links.csv')
# product_links = ['https://www.sephora.com/product/the-dewy-skin-cream-P441101?skuId=2181006&icid2=products%20grid:p441101:product']

# result = []
# for i, link in enumerate(product_links[:]):
#     result.append(get_data(link, px_list_))
#     pd_df = pd.DataFrame(result)
#     pd_df.to_csv('data/pd_info.csv', index=False)
#     print(f'{i + 1:04d} / {len(product_links)} || {link}')

url='https://www.sephora.com/shop/hair-products'
options = webdriver.ChromeOptions() 
options.add_experimental_option("excludeSwitches", ["enable-logging"])

driver=webdriver.Chrome()
# driver.set_window_position(-10000,0)
driver.get(str(url))
content=driver.find_element(By.TAG_NAME,'body')
with open(f'Docs/sephora/test.txt', 'w',encoding='utf8') as f:
    f.write(content.get_attribute('innerHTML'))
# print(content)
# time.sleep(2000)
btn_model=driver.find_element(By.CLASS_NAME,'css-1kna575')
btn_model.click()
time.sleep(10)
btn_sign=driver.find_element(By.CLASS_NAME,'css-1kna575')
btn_sign.click()
SCROLL_PAUSE_TIME = 0.5

# Get scroll height
last_height = driver.execute_script("return document.body.scrollHeight")

while True:
    # Scroll down to bottom
    driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")

    # Wait to load page
    time.sleep(SCROLL_PAUSE_TIME)

    # Calculate new scroll height and compare with last scroll height
    new_height = driver.execute_script("return document.body.scrollHeight")
    if new_height == last_height:
        break
    last_height = new_height
# time.sleep(2000)
product=driver.find_elements(By.ID,'css-h5rga0')
# print(product)
for x in product:
    a=driver.find_elements(By.TAG_NAME,'a')
    for y in a:
        print(y.get_attribute('href'))

