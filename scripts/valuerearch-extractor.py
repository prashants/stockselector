# The MIT License (MIT)
#
# Copyright (c) 2014 Prashant Shah <pshah.mumbai@gmail.com>
#
# Permission is hereby granted, free of charge, to any person obtaining a copy
# of this software and associated documentation files (the "Software"), to deal
# in the Software without restriction, including without limitation the rights
# to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
# copies of the Software, and to permit persons to whom the Software is
# furnished to do so, subject to the following conditions:
#
# The above copyright notice and this permission notice shall be included in
# all copies or substantial portions of the Software.
#
# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
# IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
# FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
# AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
# LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
# OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
# THE SOFTWARE.

import sqlite3
import csv
import time

# Constants
stock_database = "../database/db.sqlite"

download_directory = "../downloads/"

# Stock data files downloaded from valueresearch
overview_file = download_directory + "ValueResearch-Stocks-Overview-2015December27.csv"
essential_file = download_directory + "ValueResearch-Stocks-Essential-Checks-2015December27.csv"
returns_file = download_directory + "ValueResearch-Stocks-Returns-2015December27.csv"
health_file = download_directory + "ValueResearch-Stocks-Financial_Health-2015December27.csv"
growth_file = download_directory + "ValueResearch-Stocks-Growth-2015December27.csv"
valuation_file = download_directory + "ValueResearch-Stocks-Valuation-2015December27.csv"

# Open database connection
conn = sqlite3.connect(stock_database)
c = conn.cursor()

company_data = []

def process_company_data():
	sector = 0
	industry = 0
	with open(overview_file, "rU") as data_file:
		csv_reader = csv.reader(data_file,delimiter=',')
		# Skip first 3 row
		csv_reader.next()
		csv_reader.next()
		csv_reader.next()
		for row in csv_reader:
			# Calculate sector
			if row[1] == "Technology":
				sector = 1
			# Calculate industry
			if row[2] == "Computer Software":
				industry = 1
			elif row[2] == "Computer Hardware":
				industry = 2

			# Insert company data
			try:
				c.execute("INSERT INTO company (name, sector, industry) VALUES ('{name}', {sector}, {industry})".\
					format(name = row[0], sector = sector, industry = industry))
			except sqlite3.Error as e:
				print "An error occurred:", e.args[0]
	conn.commit()

process_company_data()

def init_company_data():
	global company_data
	c.execute("SELECT * FROM company")
	result = c.fetchall()
	for row in result:
		company_data.append([row[0], row[1]])

init_company_data()

def process_overview():
	price = 0.0
	high_52 = 0.0
	low_52 = 0.0
	pe = 0.0
	pb = 0.0
	enterprise_value = 0.0
	market_cap = 0.0

	with open(overview_file, "rU") as data_file:
		csv_reader = csv.reader(data_file,delimiter=',')
		# Skip first 3 row
		csv_reader.next()
		csv_reader.next()
		csv_reader.next()
		for csv_row in csv_reader:
			# Filter data
			price = csv_row[3] if csv_row[3] != '-' else 0.0
			high_52 = csv_row[6] if csv_row[6] != '-' else 0.0
			low_52 = csv_row[7] if csv_row[7] != '-' else 0.0
			pe = csv_row[8] if csv_row[8] != '-' else 0.0
			pb = csv_row[9] if csv_row[9] != '-' else 0.0
			enterprise_value = csv_row[10] if csv_row[10] != '-' else 0.0
			market_cap = csv_row[11] if csv_row[11] != '-' else 0.0

			for item in company_data:
				if item[1] == csv_row[0]:
					item.append(price)
					item.append(high_52)
					item.append(low_52)
					item.append(pe)
					item.append(pb)
					item.append(enterprise_value)
					item.append(market_cap)
					break

process_overview()

def process_essential():
	altman_score = 0.0
	piotroski_f_score = 0.0
	modified_c_score = 0.0
	current_pe = 0.0
	median_pe = 0.0
	current_pb = 0.0
	median_pb = 0.0
	earning_yield = 0.0
	peg = 0.0

	with open(essential_file, "rU") as data_file:
		csv_reader = csv.reader(data_file,delimiter=',')
		# Skip first 3 row
		csv_reader.next()
		csv_reader.next()
		csv_reader.next()
		for csv_row in csv_reader:
			# Filter data
			altman_score = csv_row[3] if csv_row[3] != '-' else 0.0
			piotroski_f_score = csv_row[4] if csv_row[4] != '-' else 0.0
			modified_c_score = csv_row[5] if csv_row[5] != '-' else 0.0
			current_pe = csv_row[6] if csv_row[6] != '-' else 0.0
			median_pe = csv_row[7] if csv_row[7] != '-' else 0.0
			current_pb = csv_row[8] if csv_row[8] != '-' else 0.0
			median_pb = csv_row[9] if csv_row[9] != '-' else 0.0
			earning_yield = csv_row[10] if csv_row[10] != '-' else 0.0
			peg = csv_row[11] if csv_row[11] != '-' else 0.0

			for item in company_data:
				if item[1] == csv_row[0]:
					item.append(altman_score)
					item.append(piotroski_f_score)
					item.append(modified_c_score)
					item.append(current_pe)
					item.append(median_pe)
					item.append(current_pb)
					item.append(median_pb)
					item.append(earning_yield)
					item.append(peg)
					break

process_essential()

def process_returns():
	return_1_day = 0.0
	return_1_week = 0.0
	return_1_month = 0.0
	return_3_months = 0.0
	return_1_year = 0.0
	return_3_years = 0.0
	return_5_years = 0.0
	return_10_years = 0.0

	with open(returns_file, "rU") as data_file:
		csv_reader = csv.reader(data_file,delimiter=',')
		# Skip first 3 row
		csv_reader.next()
		csv_reader.next()
		csv_reader.next()
		for csv_row in csv_reader:
			# Filter data
			return_1_day = csv_row[3] if csv_row[3] != '-' else 0.0
			return_1_week = csv_row[4] if csv_row[4] != '-' else 0.0
			return_1_month = csv_row[5] if csv_row[5] != '-' else 0.0
			return_3_months = csv_row[6] if csv_row[6] != '-' else 0.0
			return_1_year = csv_row[7] if csv_row[7] != '-' else 0.0
			return_3_years = csv_row[8] if csv_row[8] != '-' else 0.0
			return_5_years = csv_row[9] if csv_row[9] != '-' else 0.0
			return_10_years = csv_row[10] if csv_row[10] != '-' else 0.0

			for item in company_data:
				if item[1] == csv_row[0]:
					item.append(return_1_day)
					item.append(return_1_week)
					item.append(return_1_month)
					item.append(return_3_months)
					item.append(return_1_year)
					item.append(return_3_years)
					item.append(return_5_years)
					item.append(return_10_years)
					break

process_returns()

def process_health():
	roe = 0.0
	operating_margin = 0.0
	free_cash_flow = 0.0
	debt_equity_ratio = 0.0
	long_term_debt = 0.0
	networth = 0.0

	with open(health_file, "rU") as data_file:
		csv_reader = csv.reader(data_file,delimiter=',')
		# Skip first 3 row
		csv_reader.next()
		csv_reader.next()
		csv_reader.next()
		for csv_row in csv_reader:
			# Filter data
			roe = csv_row[3] if csv_row[3] != '-' else 0.0
			operating_margin = csv_row[4] if csv_row[4] != '-' else 0.0
			free_cash_flow = csv_row[5] if csv_row[5] != '-' else 0.0
			debt_equity_ratio = csv_row[6] if csv_row[6] != '-' else 0.0
			long_term_debt = csv_row[7] if csv_row[7] != '-' else 0.0
			networth = csv_row[8] if csv_row[8] != '-' else 0.0

			for item in company_data:
				if item[1] == csv_row[0]:
					item.append(roe)
					item.append(operating_margin)
					item.append(free_cash_flow)
					item.append(debt_equity_ratio)
					item.append(long_term_debt)
					item.append(networth)
					break

process_health()

def process_growth():
	revenue_growth_1y = 0.0
	eps_growth_1y = 0.0
	book_value_growth_1y = 0.0
	revenue_growth_3y = 0.0
	eps_growth_3y = 0.0
	book_value_growth_3y = 0.0
	revenue_growth_5y = 0.0
	eps_growth_5y = 0.0
	book_value_growth_5y = 0.0

	with open(growth_file, "rU") as data_file:
		csv_reader = csv.reader(data_file,delimiter=',')
		# Skip first 3 row
		csv_reader.next()
		csv_reader.next()
		csv_reader.next()
		for csv_row in csv_reader:
			# Filter data
			revenue_growth_1y = csv_row[3] if csv_row[3] != '-' else 0.0
			eps_growth_1y = csv_row[4] if csv_row[4] != '-' else 0.0
			book_value_growth_1y = csv_row[5] if csv_row[5] != '-' else 0.0
			revenue_growth_3y = csv_row[6] if csv_row[6] != '-' else 0.0
			eps_growth_3y = csv_row[7] if csv_row[7] != '-' else 0.0
			book_value_growth_3y = csv_row[8] if csv_row[8] != '-' else 0.0
			revenue_growth_5y = csv_row[9] if csv_row[9] != '-' else 0.0
			eps_growth_5y = csv_row[10] if csv_row[10] != '-' else 0.0
			book_value_growth_5y = csv_row[11] if csv_row[11] != '-' else 0.0

			for item in company_data:
				if item[1] == csv_row[0]:
					item.append(revenue_growth_1y)
					item.append(eps_growth_1y)
					item.append(book_value_growth_1y)
					item.append(revenue_growth_3y)
					item.append(eps_growth_3y)
					item.append(book_value_growth_3y)
					item.append(revenue_growth_5y)
					item.append(eps_growth_5y)
					item.append(book_value_growth_5y)
					break

process_growth()

def process_valuation():
	ev_to_ebidta = 0.0
	price_to_sales = 0.0
	price_to_cash_flow = 0.0

	with open(valuation_file, "rU") as data_file:
		csv_reader = csv.reader(data_file,delimiter=',')
		# Skip first 3 row
		csv_reader.next()
		csv_reader.next()
		csv_reader.next()
		for csv_row in csv_reader:
			# Filter data
			ev_to_ebidta = csv_row[10] if csv_row[10] != '-' else 0.0
			price_to_sales = csv_row[11] if csv_row[11] != '-' else 0.0
			price_to_cash_flow = csv_row[12] if csv_row[12] != '-' else 0.0

			for item in company_data:
				if item[1] == csv_row[0]:
					item.append(ev_to_ebidta)
					item.append(price_to_sales)
					item.append(price_to_cash_flow)
					break

process_valuation()

def save_database():
	date = time.strftime("%d-%m-%Y")
	for item in company_data:
		# Insert company data
		try:
			c.execute("INSERT INTO stocks (company_id, date,\
				price, high_52, low_52, pe, pb, enterprise_value, market_cap,\
				altman_z_score, piotroski_f_score, modified_c_score, current_pe, median_pe, current_pb, median_pb,\
				earning_yield, peg, return_1_day, return_1_week, return_1_month, return_3_months, return_1_year,\
				return_3_years, return_5_years, return_10_years, roe, operating_margin, free_cash_flow,\
				debt_equity_ratio, long_term_debt, networth, revenue_growth_1y, eps_growth_1y, book_value_growth_1y,\
				revenue_growth_3y, eps_growth_3y, book_value_growth_3y, revenue_growth_5y, eps_growth_5y,\
				book_value_growth_5y, ev_to_ebidta, price_to_sales, price_to_cash_flow) VALUES (\
				?, ?, ?, ?, ?, ?, ?, ?,	?, ?, ?, ?, ?, ?, ?,\
				?, ?, ?, ?, ?, ?, ?, ?,	?, ?, ?, ?, ?, ?, ?,\
				?, ?, ?, ?, ?, ?, ?, ?,	?, ?, ?, ?, ?, ?)", (
				item[0], date,
				item[2], item[3], item[4], item[5], item[6], item[7], item[8],
				item[9], item[10], item[11], item[12], item[13], item[14], item[15],
				item[16], item[17], item[18], item[19],	item[20], item[21], item[22],
				item[23], item[24], item[25], item[26], item[27], item[28],
				item[29], item[30], item[31], item[32], item[33], item[34],
				item[35], item[36], item[37], item[38], item[39],
				item[40], item[41], item[42], item[43]))
		except sqlite3.Error as e:
			print "An error occurred:", e.args[0]

save_database()

# Close database connection
conn.commit()
conn.close()
