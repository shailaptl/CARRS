// Michael G. Merritt - Data log simulation

#include <iostream>
#include <vector>
#include <cstdlib>
#include <ctime>
#include <random>
#include <stdlib.h>
#include <fstream>
#include <sstream>

using namespace std;

// vector to hold generated data
vector<string> vRando;

	// creates a random '1' or '0', returns as a string
	string randomOneOrZero() {
		// Generates a random number between 1 and 0
		double randomNumber = rand()%2;
		int randomNumberInt = int (randomNumber);
		string randomNumberString = to_string(randomNumberInt);
		// Returns the random number in a string
		return randomNumberString;	
	}
	
	// gets the current date, returns as a string
	string currentDate() {
		time_t t = time(0);
		struct tm *currentTime = localtime(&t);
		int month = currentTime->tm_mon + 1;
		int day = currentTime->tm_mday;
		int year = (currentTime->tm_year + 1900);
		string currentDate = to_string(month) + "_" + to_string(day) +
		"_" + to_string(year);
		
		return currentDate;
	}

	// generates a random timestamp string with identifier, adds to vector
	void randomTimeString() {
		// loop to create an entire day of random timestamps
		for (int i = 0; i < 24; i++) {
			for (int j = 0; j < 60; j++) {		
				for (int k = 0; k < 60; k++) {	
					int hour = i;
					string hourString = to_string(hour) + ":";
					if (i < 10) {
						hourString = "0" + hourString;
					}
						int minutes = j;
						string minutesString = to_string(minutes) + ":";
						if (j < 10) {
							minutesString = "0" + minutesString;
						}
							int seconds = k;
							string secondsString = to_string(seconds)  + " ";
							if (k < 10) {
								secondsString = "0" + secondsString;
							}
				// adds elements to vector
				vRando.push_back(randomOneOrZero() + " " + hourString + minutesString + secondsString + currentDate());
				}
			}
		}
	}

	// prints out elements to log file from the vector
	void printRandomToLog() {
			// prints six logs: 'j < 6'
			for (int j = 0; j < 6; j++) {
				randomTimeString();
				// creates a file
				ofstream file;
				// creates filename
				string fileName = "T" + to_string(j+1) + "_" + currentDate() + "_" + "log.txt";
				// print to console 
				cout << "Writing: " << fileName << endl;	
				// opens the file
				file.open(fileName);
				
				// makes sure that there are not consecutive 1's
				for (int i = 0; i < vRando.size(); ++i) {
					if ((vRando[i].front() == '1') && (vRando[i+1].front() == '1')) {
						vRando[i+1].front() = '0';
					}
				}
								
				// writes vector to file
				for (int i = 0; i < vRando.size(); ++i) {
					file << vRando[i] << endl;
				}
				
				// clears vector for repopulation
				vRando.clear();
				//closes the file
				file.close();
			}
	}

int main(int argc, char *argv[]) {	
	srand(time(NULL));
	printRandomToLog();
	exit(0);
}