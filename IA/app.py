from flask import Flask, render_template, jsonify, request
import json
import requests
import os

app = Flask(__name__)

# Cargar datos de ejemplo (drivers, equipos, carreras)
DATA_FILE = os.path.join(os.path.dirname(__file__), "data", "sample_data.json")

def load_sample_data():
    with open(DATA_FILE, "r", encoding="utf-8") as f:
        return json.load(f)

@app.route("/")
def index():
    data = load_sample_data()
    return render_template("index.html", data=data)

# Endpoint para devolver JSON (útil para JS dinámico)
@app.route("/api/drivers")
def api_drivers():
    data = load_sample_data()
    return jsonify(data.get("drivers", []))

# Endpoint opcional: obtener últimas carreras desde Ergast (API pública)
@app.route("/api/ergast/latest")
def ergast_latest():
    try:
        resp = requests.get("https://ergast.com/api/f1/current/last/results.json", timeout=6)
        resp.raise_for_status()
        return jsonify(resp.json())
    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == "__main__":
    app.run(debug=True, port=5000)
