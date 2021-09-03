import re
import time
from flask_mysqldb import MySQL
import MySQLdb.cursors
from flask import Flask, flash, render_template, url_for, request, redirect, session
from modules.kmpmatcher import validate_uname
from flask_wtf import FlaskForm
from wtforms import StringField, PasswordField, SubmitField
from wtforms.validators import DataRequired, ValidationError

class RegistrationForm(FlaskForm):
    username = StringField('Username',validators=[DataRequired()])
    password = PasswordField('Password', validators=[DataRequired()])
    submit = SubmitField('Submit')

    def validate_string(self,username):
        result = validate_uname(username)
        return result

app = Flask(__name__)
app.config['SECRET_KEY'] = 'JARGONa'
app.config['MYSQL_HOST'] = '127.0.0.1'
app.config['MYSQL_USER'] = 'root'
app.config['MYSQL_PASSWORD'] = ''
app.config['MYSQL_DB'] = 'pythonlogin'

mysql = MySQL(app)

@app.route('/index', methods=["GET","POST"])
def index():
    error = None
    form = RegistrationForm()
    username = form.username.data
    password = form.password.data
    cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
    cursor.execute('SELECT * FROM accounts WHERE username = %s AND password = %s', (username, password,))
    account = cursor.fetchone()
    if request.method == "POST" and form.is_submitted():
        if form.validate_string(username):
            error = flash('Malicious SQL Injection Detected', 'error')
                # return redirect(url_for('fun'))
        elif account:
                # Create session data, we can access this data in other routes
            session['loggedin'] = True
            session['id'] = account['id']
            session['username'] = account['username']
            session['password'] = account['password']
            # flash('Success')
            time.sleep(3)
            return redirect(url_for('home'))
        else:
            # Account doesnt exist or username/password incorrect
            error = flash('Incorrect username/password!', 'error')
    return render_template('index.html', form=form, error=error)
@app.route('/fun')
def fun():
    return render_template('pythonlogin/templates/home.html', username='mn')
@app.route('/home')
def home():
    # Check if user is loggedin
    if 'loggedin' in session:
        # User is loggedin show them the home page
        return render_template('pythonlogin/templates/home.html', username=session['username'])
    # User is not loggedin redirect to login page
    return redirect(url_for('index'))

@app.route('/profile')
def profile():
    # Check if user is loggedin
    if 'loggedin' in session:
        # We need all the account info for the user so we can display it on the profile page
        cursor = mysql.connection.cursor(MySQLdb.cursors.DictCursor)
        cursor.execute('SELECT * FROM accounts WHERE id = %s', (session['id'],))
        account = cursor.fetchone()
        # Show the profile page with account info
        return render_template('pythonlogin/templates/profile.html', account=account)
    # User is not loggedin redirect to login page
    return redirect(url_for('login'))


@app.route('/logout')
def logout():
    # Remove session data, this will log the user out
   session.pop('loggedin', None)
   session.pop('id', None)
   session.pop('username', None)
   # Redirect to login page
   return redirect(url_for('index'))

if __name__ == '__main__':
    app.run(debug=True)