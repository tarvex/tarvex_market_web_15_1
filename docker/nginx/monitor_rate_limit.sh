#!/bin/bash

# Configuration
LOG_FILE="/var/log/nginx/rate_limit.log"
ALERT_THRESHOLD=5  # Number of rejected requests to trigger alert
CHECK_INTERVAL=60  # Check every 60 seconds
EMAIL_TO="akram.tj1@gmail.com"  # Change this to your email

# Function to send email alert
send_alert() {
    local ip=$1
    local count=$2
    local subject="Rate Limit Alert: $ip has exceeded limit $count times"
    local body="IP Address: $ip\nRejected Requests: $count\nTime: $(date)"
    
    echo -e "$body" | mail -s "$subject" "$EMAIL_TO"
}

# Main monitoring loop
while true; do
    # Get IPs that exceeded rate limit in the last minute
    rejected_ips=$(grep "Rate-Limit: REJECTED" "$LOG_FILE" | awk '{print $1}' | sort | uniq -c | sort -nr)
    
    # Process each IP
    echo "$rejected_ips" | while read count ip; do
        if [ -n "$ip" ] && [ "$count" -ge "$ALERT_THRESHOLD" ]; then
            echo "Alert: $ip has exceeded rate limit $count times"
            send_alert "$ip" "$count"
        fi
    done
    
    # Wait before next check
    sleep "$CHECK_INTERVAL"
done 