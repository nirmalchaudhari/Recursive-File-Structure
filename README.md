# Recursive-File-Structure

Search Web App Documents.

1) Step to Install
	1.1 Create database "flstrcture" & run below query
		CREATE TABLE `migseed` (
  			`name` varchar(100) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
	1.2 Open config file set your database configuration for mysql. 

2) Why it’s fast in search and useful.
Here we are storing path like when we read property of object like file and directory we always look the path. Its going to take time for edit and insert because we have to take parent and its path and concatenate it. But now days storage are easily available and not cost too much. So path variable is easy to search the path in list for our solution.

Even though we haven’t used any third party library and even we are using db.php file for core functions and no jquery or extra css is used.

3) Step to run 
Just put this folder inside apache or nginx and run /index.html 
for example : http://localhost/pratical/netpay/nirmal/index.html
