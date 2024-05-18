from flask import Flask, jsonify, request
import re #Xoá các dòng comment /**/ trong file php
import os #Chạy lấy toàn bộ file
import math #Tính toán information entropy
import pandas as pd #Thao tác tạo file csv theo cấu trúc
import numpy as np
import pickle
from collections import Counter #Đếm số lượng từ xuất hiện trong file
import utils
import json

global model
model = None
app = Flask(__name__)

@app.route("/", methods=["GET"])
def hello():
    return 'GET active'

@app.route("/predict", methods=["POST"])
def _predict():
    F1 = []
    F2 = []
    F3 = []
    F4 = []
    F5 = []
    F6 = []
    F7 = []
    F8 = []
    F9 = []
    F10 = []
    F11 = []
    F12 = []
    F13 = []
    F14 = []
    F15 = []
    F16 = []
    class_att = []
    def_arr = ['eval']
    faf_arr = ['wget', 'curl', 'lynx', 'get', 'fetch']
    rcf_arr = ['perl', 'python', 'gcc', 'chmod', 'nohup', 'nc ']
    icf_arr = ['uname', 'id', 'ver', 'sysctl', 'whoami', '$OSTYPE', 'pwd']
    word = ['$_GET', '$_POST', '$_COOKIE', '$_REQUEST', '$_FILES', '$_SESSION']

    temp = list()
    temp2 = list()
    file_content =  request.files["file"].read().decode('latin-1')
    sample = utils.process(file_content)
    temp = utils.count_word(sample, word)
    temp2 = utils.cal_loop_ratio(sample)

    # Gộp mảng lại
    F1.append(temp[0])
    F2.append(temp[1])
    F3.append(temp[2])
    F4.append(temp[3])
    F5.append(temp[4])
    F6.append(temp[5])
    F7.append(temp2[0])
    F8.append(temp2[1])
    F9.append(temp2[2])
    F10.append(utils.cal_mal_func(sample, def_arr))
    F11.append(utils.cal_mal_func(sample, faf_arr))
    F12.append(utils.cal_mal_func(sample, rcf_arr))
    F13.append(utils.cal_mal_func(sample, icf_arr))
    F14.append(utils.count_max_len_word(sample))
    F15.append(utils.count_max_len_line(sample))
    F16.append(utils.calculate_entropy(sample))

    data = {
        'GET': F1,
        'POST': F2,
        'COOKIE': F3,
        'REQUEST': F4,
        'FILES': F5,
        'SESSION': F6,
        'elseif': F7,
        'for': F8,
        'foreach': F9,
        'DEF': F10,
        'FAF': F11,
        'RCF': F12,
        'ICF': F13,
        'maxWordLen': F14,
        'maxLineLen': F15,
        'entropy': F16,
    }

    target = pd.DataFrame(data)
    temp = model.predict(target)
    
    result = {"result": int(temp)}
    return json.dumps(result)

if __name__ == '__main__':
    print("App run!")
    # Load model
    model = utils._load_model()
    app.run(debug=False,host="0.0.0.0")