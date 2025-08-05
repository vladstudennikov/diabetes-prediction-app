from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
import joblib
import pandas as pd

# Load model
model = joblib.load('model.pkl')

# Feature input schema
class Features(BaseModel):
    Age: int
    BMI: float
    CholCheck: int
    DiffWalk: int
    Fruits: int
    GenHlth: int
    HeartDiseaseorAttack: int
    HighBP: int
    HighChol: int
    HvyAlcoholConsump: int
    MentHlth: int
    NoDocbcCost: int
    PhysActivity: int
    PhysHlth: int
    Smoker: int
    Stroke: int

app = FastAPI()

@app.post("/predict")
def predict(features: Features):
    try:
        df = pd.DataFrame([features.dict()])
        prediction = model.predict(df)[0]
        probability = model.predict_proba(df)[0][1]
        return {
            "prediction": int(prediction),
            "probability": round(float(probability), 3)
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))