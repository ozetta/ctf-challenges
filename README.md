# No One Plays' CTF Challenges
Awfully Bad Challenges


## DNA Box

[Source code](2017/dnabox)

Solved: 1 / ??

### Description

* Summary: PHP shell with limited character set "ACGTacgt" (i.e. DNA symbols)
* You can upload files that only contain characters in the restricted character set
* You can include any files you uploaded 
* But what's the point if you can only include files that only contains that eight characters?
* **As a result, no one plays** (maybe)

### Write-ups
http://blog.samueltang.net/archives/382



## Lock Pick Duck

[Source code](2018/LockPickDuck)
* Partially solved:  5 / 17
* Completely solved: 0 / 17

### Description

* Summary: One injection payload breaks in six databases
* `?username=|&password` breaks csvdb1
* `?username=%27or+1--&password` breaks sqldb1
* `?username=&password=%27or%271` breaks sqldb1 and xmldb1
* `?username=()|&password` breaks csvdb1 and csvdb2
* `?username=%27union%20select%20%27A%27--&password=A` breaks sqldb1 and sqldb2
* `?username&password=A` breaks xmldb2
* Good luck



### Return Programming Oriented

[Source code](2018/ReturnProgrammingOriented)

Solved: 0 / 17

* Summary: RPO + CSS Exfil
* Buggy rewrite rule got RPO by adding &
* `$_GET['ln']` can redirect internal webpages or show reflective warning message when the URL is external website 
* Show flag in the ads using redirect
* CSS payload goes to style.css using warning message
* **No one plays, no write ups**
