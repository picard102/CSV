# CSV

Needed to take several CSV files containing registration information, and update the registrant information 
(Twitter, Website, etc).

Problem

Was trying to import the lists for each year into MailChimp and have it merge the data as each year was added to prevent 
duplicate entries. However their merge function reads null as an update, so it would replace the value with nothing. 
Throughout the years we've asked for diffrent information each year and this resulted in none of the data except for 
the last uploaded CSV to be retained. 

The idea was to normalize the data across all the files in a way that ignored empty cells when replacing values. 

So this script will take an input file as an array, loop through it and search every other year for entries with matching 
email address's and update the other cells with the most recent data that exists for that email. 
