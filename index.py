from flask import Flask, render_template, request, jsonify
from services.get import send  # birleşik gateway önerisi

app = Flask(__name__, template_folder="templates", static_folder="static")

@app.route("/")
def panel():
    return render_template("panel.html")

@app.route("/send", methods=["POST"])
def send_route():
    mobile = request.form.get("mobile") or (request.json and request.json.get("mobile"))
    if not mobile:
        return jsonify({"success": False, "message": "mobile parametresi gerekli"}), 400

    result_file = send(mobile, provider="file")
    result_kredim = send(mobile, provider="kredim")
    return jsonify({"file_market": result_file, "kredim": result_kredim})

@app.route("/send", methods=["POST"])
def send_sms():
    number = request.form.get("number")
    service = request.form.get("service")

    if service == "metro":
        success, source = Metro(number)
    elif service == "akasya":
        success, source = Akasya(number)
    else:
        success, source = False, "unknown"

    if success:
        return jsonify({"status": "success", "msg": f"{source} üzerinden SMS gönderildi"})
    else:
        return jsonify({"status": "error", "msg": f"{source} üzerinden hata oluştu"})

if __name__ == "__main__":
    app.run(debug=True)
