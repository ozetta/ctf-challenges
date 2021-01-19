from selenium import webdriver
import os
FLAG = os.getenv("FLAG", "firebird{Boku_no_Yakitori_Chan}")	#default is fake flag as expected

def submit(sess):
	chrome_options = webdriver.ChromeOptions()
	chrome_options.add_argument("--disable-gpu")
	chrome_options.add_argument("--headless")
	chrome_options.add_argument("--no-sandbox")
	driver = webdriver.Chrome(options=chrome_options)
	driver.implicitly_wait(3)

	driver.get("http://localhost/login")
	driver.add_cookie({"name": "session", "value": sess})
	driver.find_element_by_xpath("(//input)[1]").send_keys("Black Bauhinia")
	driver.find_element_by_xpath("(//input)[2]").send_keys("BL@ckB6a")	#Nobody cares about the password
	driver.find_element_by_xpath("(//input)[3]").click()

	flag = False
	if(driver.current_url == "http://localhost/"):
		driver.find_element_by_xpath("(//a)[3]").click()
		if(driver.current_url == "http://localhost/challenge"):
			flag = True
			driver.find_element_by_xpath("//fieldset[1]//input[1]").send_keys(FLAG)
			driver.find_element_by_xpath("//fieldset[1]//input[3]").click()

	print(driver.current_url, flush=True)	#TODO: check whether the flag is accepted

	driver.get("http://localhost/logout")
	for cookie in driver.get_cookies():
		if cookie["name"] == "session" and cookie["httpOnly"] == True:
			sess = cookie["value"]
			break
			
	driver.quit()
	return sess, flag