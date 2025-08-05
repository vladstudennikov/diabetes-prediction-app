# Base image
FROM python:3.11-slim

# Set working directory
WORKDIR /app

# Copy code
COPY main.py .
COPY model.pkl .
COPY requirements.txt .

# Install dependencies
RUN pip install --no-cache-dir -r requirements.txt

# Expose FastAPI port
EXPOSE 3000

# Start the FastAPI server
CMD ["python", "-m", "uvicorn", "main:app", "--host", "0.0.0.0", "--port", "3000"]