from flask import Flask, Response, request, redirect, session, escape
import bot

app = Flask(__name__)
app.secret_key = "iluvfirebirdchan"
#hardcoded db with plaintext password is efficient
users = {"Black Bauhinia": "BL@ckB6a","Firebird": "F!reb1rd"}
webs= {"Black Bauhinia": "https://twitter.com/BlackB6a", "Firebird": "https://intro.firebird.sh/"}
head = "<html><head><title>Boku no Firebird CTF</title><body>"
head2 = "<p>Welcome, %s<p><a href=/>Scoreboard</a> | <a href=/profile>Profile</a> | <a href=/challenge>Challenge</a> | <a href=/logout>Logout</a><hr>"

@app.route("/")
def index():
	if not session.get("user"):
	    return redirect("/login")
	else:
		user = session.get("user")
		webn = webs.copy()
		for u in users:
			if session.get("web-"+u):
				webn[u] = session.get("web-"+u)	
		return head+head2%user+"""
<h2>Scoreboard</h2>
<table>
<tr><td>Rank<td>Team Name<td>Score
<tr><td>1<td><a href=%s target=_blank>Black Bauhinia</a><td>0
<tr><td>2<td><a href=%s target=_blank>Firebird</a><td>0
</table>
""" % (webn["Black Bauhinia"],webn["Firebird"])

@app.route("/profile", methods=["GET", "POST"])
def profile():
	if not session.get("user"):
	    return redirect("/login")
	else:
		user = session.get("user")
		if request.method == "POST":
			session["web-"+user] = escape(request.form["website"])
			return head+head2%user+"<p>Updated.<p><a href=javascript:history.back()>Go back"
		else:
			return head+head2%user+"""<h2>Profile</h2><form method=post>
<p>Website: <input name=website value=%s>
<input type=submit>
""" % session.get("web-"+user,webs[user])

@app.route("/challenge", methods=["GET", "POST"])
def challenge():
	if not session.get("user"):
	    return redirect("/login")
	else:
		user = session.get("user")
		if request.method == "POST":
			print(request.form["flag"], flush=True)
			return head+head2%user+"<p>Wrong Flag. <p><a href=javascript:history.back()>Go back"
		else:
			return head+head2%user+"""<h2>Challenge</h2>
<fieldset><h3>Sanity Check</h3>
<p>Welcome! Flag is <!-- not --> <code>firebird{Boku_no_Yakitori_Chan}</code>
<form method=post>
<p>Flag: <input name=flag>
<input type=hidden name=id value=1>
<input type=submit>
</form>
</fieldset>
<fieldset><h3>The Real Question</h3>
<p>Can you pwn the Echo Service?
<p><code oncopy=location=`https://www.youtube.com/watch?v=NpP3rrNoEqo`>nc checksec.sh 5380</code>
<form method=post>
<p>Flag: <input name=flag>
<input type=hidden name=id value=2>
<input type=submit>
</form>
</fieldset>
"""

@app.route("/login", methods=["GET", "POST"])
def login():
	if request.method == "POST":
		user = request.form["user"]
		if user in users and users[user] == request.form["pass"]:
			session["user"] = user
			return redirect("/")
		else:
			return head+"<p>Wrong Username or Password.<p><a href=javascript:history.back()>Go back"
	else:
		return head+"""<h2>Login</h2><form method=post>
<p>Username: <input name=user>
<p>Password: <input name=pass type=password>
<p><input type=submit>
"""

@app.route("/logout")
def logout():
	if not session.get("user"):
	    return redirect("/login")
	else:
		if session.get("user") == "Firebird" and request.remote_addr != "127.0.0.1": #Prevent recursive XSS
			sess, flag = bot.submit(request.cookies["session"])
			if flag:
				html = head+"<p>Logout Success. <p><a href=/login>Try again"
			else:
				html = head+"<p style=color:red>Black Bauhinia complained that Firebird is hacking the CTF platform. <p><a href=/login>Hack again"
			resp = Response(html)
			resp.headers["Set-Cookie"] = "session=%s; HttpOnly; Path=/" % sess
			return resp
		else:
			session["user"] = None
			return redirect("/login")

if __name__ == "__main__":
	app.run(host="0.0.0.0", port=80)