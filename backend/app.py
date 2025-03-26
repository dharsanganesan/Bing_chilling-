from flask import Flask, request, jsonify
from flask_cors import CORS  # To handle cross-origin requests
import requests

app = Flask(__name__)
CORS(app)  # Enable CORS for frontend-backend communication

# JDoodle API Credentials (Replace with your actual credentials)
JDoodle_CLIENT_ID = "your_client_id"
JDoodle_CLIENT_SECRET = "your_client_secret"
JDoodle_API_URL = "https://api.jdoodle.com/v1/execute"

@app.route("/compile", methods=["POST"])
def compile_code():
    data = request.json
    language = data.get("language", "python3")
    code = data.get("code", "")
    user_input = data.get("input", "")

    payload = {
        "clientId": '5e6aef06f0084b20b055a16b4f6156e0',
        "clientSecret": '74020f0da6fc301f2cd0f33490c77d9ad6c409544fa66e23616da9d999e16029',
        "script": code,
        "language": language,
        "versionIndex": "0",
        "stdin": user_input
    }

    response = requests.post(JDoodle_API_URL, json=payload)

    try:
        return jsonify(response.json())  # Return API response
    except Exception as e:
        return jsonify({"error": str(e)})

if __name__ == "__main__":
    app.run(debug=True)
