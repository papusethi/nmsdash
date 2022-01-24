# Author : Papu Sethi
# Before executing: search for "very important" comments

import mysql.connector
import time
import random
import datetime


def gen_date_time(year, month, day, hour):
    return datetime.datetime(year, month, day, hour)


print("-" * 40)
print("Welcome to IoT Device")
print("-" * 40)

HOST_IP = input("\n[+] Enter Server IP Address: ")
PORT_NO = int(input("[+] Enter Server Port Number: "))
USER = "root"
PASSWORD = ""


try:
    conn = mysql.connector.connect(
        host=HOST_IP, port=PORT_NO, user=USER, password=PASSWORD, database="noiseapp")

    if conn.is_connected():
        print("[OK] Connected to server.")

        block_name = input("[+] Enter Your Block Name: ")
        block_passwd = input("[+] Enter Block Password: ")

        # For Block level authentication we are using the 'block' table not 'loginiot' table data

        auth_query = "SELECT * FROM block WHERE block_name = BINARY %s and block_passwd = BINARY %s"
        auth_query_value = (block_name, block_passwd)

        auth_cursor = conn.cursor()
        auth_cursor.execute(auth_query, auth_query_value)

        result = auth_cursor.fetchall()

        if len(result) > 0:
            print("Authentication success")

            district_name = result[0][1]

            print("-" * 30)
            is_ready = input("Are you ready to send data? [y or n]: ")

            if is_ready == "y":
                print("Sending data...")
                try:
                    today = datetime.date.today()
                    # very important
                    # today -= datetime.timedelta(days=1)
                    day_count = 5

                    while day_count > 0:
                        hour = 0
                        # change status to running
                        update_query = "UPDATE block SET block_status = %s WHERE block_name = %s"
                        update_value = ("Running", block_name)

                        update_cursor = conn.cursor()
                        update_cursor.execute(update_query, update_value)
                        conn.commit()

                        # now send the data to temp
                        for i in range(24):
                            date_time = gen_date_time(
                                today.year, today.month, today.day, hour + i)
                            data_query = "INSERT INTO temp_noise_data (district_name, block_name, date_time, value) VALUES (%s, %s, %s, %s)"

                            data_query_value = (
                                district_name, block_name, date_time, random.randint(30, 50))

                            data_cursor = conn.cursor()
                            data_cursor.execute(data_query, data_query_value)
                            conn.commit()
                            print("!", end="")
                            time.sleep(1)

                        day_count -= 1

                        # before sending next day data, get the backup
                        query = "SELECT * FROM temp_noise_data WHERE block_name = BINARY %s and DATE(date_time) = %s"
                        value = (block_name, today)

                        select_cursor = conn.cursor()
                        select_cursor.execute(query, value)

                        result = select_cursor.fetchall()
                        # let me calculate all values from result
                        values_list = []
                        day_value = 0
                        night_value = 0

                        # accessing the values
                        for row in result:
                            values_list.append(row[4])
                        for item in values_list[0:12]:
                            day_value += item
                        for item in values_list[12:]:
                            night_value += item

                        day_value /= 10
                        night_value /= 10
                        average = (day_value + night_value)/2

                        #  now send the data to noise value table
                        query = "INSERT INTO noise_value (district_name, block_name, day_value, night_value, date, average) VALUES (%s, %s, %s, %s, %s, %s)"
                        value = (district_name, block_name, day_value,
                                 night_value, today, average)

                        insert_cursor = conn.cursor()
                        insert_cursor.execute(query, value)
                        conn.commit()

                        # okk as you got the backup its time to delete the old records
                        query = "DELETE FROM temp_noise_data WHERE DATE(date_time) = %s"
                        value = (today,)
                        delete_cursor = conn.cursor()
                        delete_cursor.execute(query, value)
                        conn.commit()
                        print("Successfully Backed Up! and Deleted\n")

                        # now lets move to the next day
                        # very important
                        today += datetime.timedelta(days=1)

                    # now update the status to stopped
                    update_query = "UPDATE block SET block_status = %s WHERE block_name = %s"
                    update_value = ("Stopped", block_name)

                    update_cursor = conn.cursor()
                    update_cursor.execute(update_query, update_value)
                    conn.commit()
                except:
                    print("\n[--] Interupted...Stopped [--]")
            else:
                print("[OK] Come again, when you will be ready.")
        else:
            print("[XX] Invalid creadentials")
    else:
        print("[XX] Failed to connect with server.")
except BaseException as e:
    print("Error: ", e)
finally:
    conn.close()
