<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlayKaro247 OTP Automation</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f7fa;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .browser-window {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .browser-header {
            background: var(--primary-color);
            padding: 10px 15px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(0,0,0,0.1);
        }
        
        .browser-controls {
            display: flex;
            gap: 8px;
            margin-right: 15px;
        }
        
        .control-btn {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            cursor: pointer;
        }
        
        .close { background: var(--danger-color); }
        .minimize { background: var(--warning-color); }
        .maximize { background: var(--success-color); }
        
        .address-bar {
            flex: 1;
            background: rgba(255,255,255,0.9);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 13px;
            color: var(--dark-color);
            border: 1px solid rgba(0,0,0,0.1);
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        }
        
        .browser-content {
            padding: 20px;
            min-height: 600px;
            position: relative;
        }
        
        .control-panel {
            background: var(--light-color);
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
            font-size: 14px;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        #startBtn {
            background: var(--success-color);
            color: white;
        }
        
        #stopBtn {
            background: var(--danger-color);
            color: white;
            display: none;
        }
        
        #refreshBtn {
            background: var(--secondary-color);
            color: white;
        }
        
        #status {
            margin-left: 15px;
            padding: 10px 15px;
            border-radius: 6px;
            background: var(--light-color);
            display: inline-block;
            font-size: 14px;
            min-width: 200px;
        }
        
        iframe {
            width: 100%;
            height: 600px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 20px;
            background: white;
        }
        
        .history {
            margin-top: 20px;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #eee;
            padding: 15px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .history-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            display: flex;
            justify-content: space-between;
        }
        
        .history-item.success {
            background-color: rgba(46, 204, 113, 0.1);
        }
        
        .history-item.error {
            background-color: rgba(231, 76, 60, 0.1);
        }
        
        .controls-group {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .speed-control {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 8px 15px;
            border-radius: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        label {
            font-size: 14px;
            font-weight: 500;
            color: var(--dark-color);
        }
        
        #speed {
            width: 120px;
            -webkit-appearance: none;
            height: 6px;
            background: #ddd;
            border-radius: 3px;
            outline: none;
        }
        
        #speed::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--secondary-color);
            cursor: pointer;
        }
        
        #speedValue {
            font-weight: 600;
            min-width: 40px;
            text-align: center;
        }
        
        .stats {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }
        
        .stat-box {
            background: white;
            padding: 10px 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            font-size: 14px;
        }
        
        .stat-value {
            font-weight: 700;
            font-size: 16px;
            color: var(--secondary-color);
        }
        
        .loading {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
            border-radius: 8px;
        }
        
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(0,0,0,0.1);
            border-radius: 50%;
            border-top-color: var(--secondary-color);
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .hidden {
            display: none;
        }
        
        .tab-container {
            display: flex;
            margin-bottom: 15px;
        }
        
        .tab {
            padding: 10px 20px;
            background: var(--light-color);
            border-radius: 8px 8px 0 0;
            margin-right: 5px;
            cursor: pointer;
            font-weight: 500;
        }
        
        .tab.active {
            background: white;
            border-bottom: 3px solid var(--secondary-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="browser-window">
            <div class="browser-header">
                <div class="browser-controls">
                    <div class="control-btn close" id="closeBtn"></div>
                    <div class="control-btn minimize" id="minimizeBtn"></div>
                    <div class="control-btn maximize" id="maximizeBtn"></div>
                </div>
                <div class="address-bar">https://playkaro247.com/join-now</div>
            </div>
            
            <div class="browser-content">
                <div class="tab-container">
                    <div class="tab active" data-tab="automation">Automation</div>
                    <div class="tab" data-tab="settings">Settings</div>
                </div>
                
                <div id="automationTab">
                    <div class="control-panel">
                        <div class="controls-group">
                            <button id="startBtn">Start Auto OTP</button>
                            <button id="stopBtn">Stop</button>
                            <button id="refreshBtn">Refresh Page</button>
                        </div>
                        
                        <div id="status">Ready</div>
                        
                        <div class="speed-control">
                            <label for="speed">Speed:</label>
                            <input type="range" id="speed" min="500" max="5000" value="2000" step="100">
                            <span id="speedValue">2000ms</span>
                        </div>
                    </div>
                    
                    <div class="loading hidden" id="loadingIndicator">
                        <div class="spinner"></div>
                    </div>
                    
                    <iframe id="siteFrame" src="https://playkaro247.com/join-now"></iframe>
                    
                    <div class="stats">
                        <div class="stat-box">
                            Attempts: <span class="stat-value" id="attemptCount">0</span>
                        </div>
                        <div class="stat-box">
                            Last OTP: <span class="stat-value" id="lastOtp">-</span>
                        </div>
                        <div class="stat-box">
                            Status: <span class="stat-value" id="currentStatus">Idle</span>
                        </div>
                    </div>
                    
                    <div class="history">
                        <h4>OTP Attempt History</h4>
                        <div id="historyList"></div>
                    </div>
                </div>
                
                <div id="settingsTab" class="hidden">
                    <h3>Settings</h3>
                    <div class="control-panel">
                        <div style="width: 100%;">
                            <h4>PlayKaro247 Element Selectors</h4>
                            <p>These selectors help the tool find the right elements on the page.</p>
                            
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                                <div>
                                    <label for="otpInputSelector">OTP Input:</label>
                                    <input type="text" id="otpInputSelector" value=".otpNumber" class="otp-input" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                                <div>
                                    <label for="submitButtonSelector">Submit Button:</label>
                                    <input type="text" id="submitButtonSelector" value=".otpBtn_" class="otp-input" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                                <div>
                                    <label for="mobileNumberSelector">Mobile Input:</label>
                                    <input type="text" id="mobileNumberSelector" value=".phoneNumber" class="otp-input" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                                <div>
                                    <label for="signupButtonSelector">Signup Button:</label>
                                    <input type="text" id="signupButtonSelector" value="#signUpButton" class="otp-input" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                            </div>
                            
                            <button id="saveSettings" style="margin-top: 20px;">Save Settings</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Enhanced configuration with defaults
        const defaultConfig = {
            otpInputSelector: '.otpNumber',
            submitButtonSelector: '.otpBtn_',
            mobileNumberSelector: '.phoneNumber',
            signupButtonSelector: '#signUpButton',
            regStepOneSelector: '.regStepOne',
            regStepTwoSelector: '.regStepTwo',
            backButtonSelector: '.mobile_otp_div_backBtn_2'
        };
        
        // Load config from localStorage or use defaults
        let config = JSON.parse(localStorage.getItem('playkaroConfig')) || defaultConfig;
        
        // State management
        const state = {
            isRunning: false,
            intervalId: null,
            currentSpeed: 2000,
            attemptCount: 0,
            usedOTPs: new Set(),
            currentTab: 'automation'
        };
        
        // DOM elements
        const elements = {
            startBtn: document.getElementById('startBtn'),
            stopBtn: document.getElementById('stopBtn'),
            refreshBtn: document.getElementById('refreshBtn'),
            status: document.getElementById('status'),
            speed: document.getElementById('speed'),
            speedValue: document.getElementById('speedValue'),
            siteFrame: document.getElementById('siteFrame'),
            historyList: document.getElementById('historyList'),
            attemptCount: document.getElementById('attemptCount'),
            lastOtp: document.getElementById('lastOtp'),
            currentStatus: document.getElementById('currentStatus'),
            loadingIndicator: document.getElementById('loadingIndicator'),
            automationTab: document.getElementById('automationTab'),
            settingsTab: document.getElementById('settingsTab'),
            tabs: document.querySelectorAll('.tab'),
            saveSettings: document.getElementById('saveSettings'),
            configInputs: {
                otpInputSelector: document.getElementById('otpInputSelector'),
                submitButtonSelector: document.getElementById('submitButtonSelector'),
                mobileNumberSelector: document.getElementById('mobileNumberSelector'),
                signupButtonSelector: document.getElementById('signupButtonSelector')
            }
        };
        
        // Initialize the UI
        function init() {
            // Set initial values
            elements.speed.value = state.currentSpeed;
            elements.speedValue.textContent = `${state.currentSpeed}ms`;
            
            // Load config into settings form
            for (const key in elements.configInputs) {
                if (config[key]) {
                    elements.configInputs[key].value = config[key];
                }
            }
            
            // Set up event listeners
            setupEventListeners();
        }
        
        // Set up all event listeners
        function setupEventListeners() {
            // Speed control
            elements.speed.addEventListener('input', function() {
                state.currentSpeed = parseInt(this.value);
                elements.speedValue.textContent = `${state.currentSpeed}ms`;
            });
            
            // Start button
            elements.startBtn.addEventListener('click', startAutomation);
            
            // Stop button
            elements.stopBtn.addEventListener('click', stopAutomation);
            
            // Refresh button
            elements.refreshBtn.addEventListener('click', function() {
                showLoading();
                elements.siteFrame.src = elements.siteFrame.src;
                setTimeout(hideLoading, 2000);
            });
            
            // Browser controls
            document.getElementById('closeBtn').addEventListener('click', function() {
                showLoading();
                elements.siteFrame.src = 'https://playkaro247.com/join-now';
                setTimeout(hideLoading, 2000);
            });
            
            // Tab switching
            elements.tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const tabName = this.getAttribute('data-tab');
                    switchTab(tabName);
                });
            });
            
            // Save settings
            elements.saveSettings.addEventListener('click', saveSettings);
            
            // Iframe load event
            elements.siteFrame.addEventListener('load', function() {
                hideLoading();
            });
        }
        
        // Switch between tabs
        function switchTab(tabName) {
            state.currentTab = tabName;
            
            // Update tab UI
            elements.tabs.forEach(tab => {
                if (tab.getAttribute('data-tab') === tabName) {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });
            
            // Show/hide content
            if (tabName === 'automation') {
                elements.automationTab.classList.remove('hidden');
                elements.settingsTab.classList.add('hidden');
            } else {
                elements.automationTab.classList.add('hidden');
                elements.settingsTab.classList.remove('hidden');
            }
        }
        
        // Save settings to localStorage
        function saveSettings() {
            const newConfig = {};
            
            for (const key in elements.configInputs) {
                newConfig[key] = elements.configInputs[key].value;
            }
            
            // Merge with existing config
            config = {...config, ...newConfig};
            localStorage.setItem('playkaroConfig', JSON.stringify(config));
            
            // Show success message
            updateStatus('Settings saved successfully', 'success');
            setTimeout(() => {
                switchTab('automation');
            }, 1500);
        }
        
        // Show loading indicator
        function showLoading() {
            elements.loadingIndicator.classList.remove('hidden');
        }
        
        // Hide loading indicator
        function hideLoading() {
            elements.loadingIndicator.classList.add('hidden');
        }
        
        // Generate a unique OTP
        function generateUniqueOTP() {
            let otp;
            do {
                otp = Math.floor(100000 + Math.random() * 900000).toString();
                
                // If we've used all possible OTPs (extremely unlikely), clear the set
                if (state.usedOTPs.size >= 900000) {
                    state.usedOTPs.clear();
                }
            } while (state.usedOTPs.has(otp));
            
            state.usedOTPs.add(otp);
            return otp;
        }
        
        // Check if we're on the OTP verification page
        function isOTPPage(frame) {
            try {
                const frameDoc = frame.contentDocument || frame.contentWindow.document;
                return frameDoc.querySelector(config.regStepTwoSelector) !== null;
            } catch (e) {
                return false;
            }
        }
        
        // Check if we're on the signup form page
        function isSignupPage(frame) {
            try {
                const frameDoc = frame.contentDocument || frame.contentWindow.document;
                return frameDoc.querySelector(config.regStepOneSelector) !== null && 
                       frameDoc.querySelector(config.signupButtonSelector) !== null;
            } catch (e) {
                return false;
            }
        }
        
        // Attempt to submit the signup form
        function attemptSignup() {
            const frame = elements.siteFrame;
            
            try {
                const frameDoc = frame.contentDocument || frame.contentWindow.document;
                const signupBtn = frameDoc.querySelector(config.signupButtonSelector);
                
                if (signupBtn) {
                    signupBtn.click();
                    logHistory('Signup form submitted', 'info');
                    return true;
                }
            } catch (e) {
                console.error('Error accessing iframe:', e);
            }
            
            return false;
        }
        
        // Automate the OTP process
        function automateOTP() {
            if (!state.isRunning) return;
            
            const frame = elements.siteFrame;
            
            try {
                const frameDoc = frame.contentDocument || frame.contentWindow.document;
                
                // Check if we're on the signup page and need to submit
                if (isSignupPage(frame)) {
                    if (attemptSignup()) {
                        updateStatus('Submitting signup form...', 'warning');
                    } else {
                        updateStatus('Error: Could not submit signup form', 'error');
                    }
                    setTimeout(automateOTP, state.currentSpeed);
                    return;
                }
                
                // Check if we're on the OTP page
                if (isOTPPage(frame)) {
                    const otp = generateUniqueOTP();
                    const otpInput = frameDoc.querySelector(config.otpInputSelector);
                    const submitBtn = frameDoc.querySelector(config.submitButtonSelector);
                    
                    if (otpInput && submitBtn) {
                        // Fill and submit OTP
                        otpInput.value = otp;
                        submitBtn.click();
                        
                        // Update stats and log
                        state.attemptCount++;
                        elements.attemptCount.textContent = state.attemptCount;
                        elements.lastOtp.textContent = otp;
                        
                        logHistory(`Attempt #${state.attemptCount}: OTP ${otp} submitted`, 'success');
                        updateStatus(`Attempt #${state.attemptCount}: OTP ${otp} submitted`, 'info');
                    } else {
                        logHistory('Error: Could not find OTP elements', 'error');
                        updateStatus('Error: Could not find OTP elements', 'error');
                    }
                } else {
                    updateStatus('Waiting for OTP page...', 'warning');
                }
            } catch (e) {
                console.error('Error accessing iframe:', e);
                logHistory('Error accessing OTP page', 'error');
                updateStatus('Error accessing OTP page', 'error');
            }
            
            // Continue the process
            setTimeout(automateOTP, state.currentSpeed);
        }
        
        // Start the automation
        function startAutomation() {
            state.isRunning = true;
            elements.startBtn.style.display = 'none';
            elements.stopBtn.style.display = 'inline-block';
            elements.currentStatus.textContent = 'Running';
            
            updateStatus('Starting OTP automation...', 'info');
            logHistory('Automation started', 'info');
            
            // Start the process
            automateOTP();
        }
        
        // Stop the automation
        function stopAutomation() {
            state.isRunning = false;
            elements.startBtn.style.display = 'inline-block';
            elements.stopBtn.style.display = 'none';
            elements.currentStatus.textContent = 'Stopped';
            
            updateStatus('OTP automation stopped', 'info');
            logHistory('Automation stopped', 'info');
        }
        
        // Update status display
        function updateStatus(message, type = 'info') {
            elements.status.textContent = message;
            
            // Reset all classes
            elements.status.style.backgroundColor = '';
            elements.status.style.color = '';
            
            // Apply type-specific styling
            switch (type) {
                case 'success':
                    elements.status.style.backgroundColor = 'rgba(46, 204, 113, 0.2)';
                    elements.status.style.color = '#27ae60';
                    break;
                case 'error':
                    elements.status.style.backgroundColor = 'rgba(231, 76, 60, 0.2)';
                    elements.status.style.color = '#e74c3c';
                    break;
                case 'warning':
                    elements.status.style.backgroundColor = 'rgba(241, 196, 15, 0.2)';
                    elements.status.style.color = '#f39c12';
                    break;
                case 'info':
                default:
                    elements.status.style.backgroundColor = 'rgba(52, 152, 219, 0.2)';
                    elements.status.style.color = '#3498db';
                    break;
            }
        }
        
        // Log to history
        function logHistory(message, type = 'info') {
            const historyEntry = document.createElement('div');
            historyEntry.className = `history-item ${type}`;
            
            const timestamp = new Date().toLocaleTimeString();
            historyEntry.innerHTML = `
                <span>${timestamp}</span>
                <span>${message}</span>
            `;
            
            elements.historyList.prepend(historyEntry);
            
            // Keep history manageable
            if (elements.historyList.children.length > 50) {
                elements.historyList.removeChild(elements.historyList.lastChild);
            }
        }
        
        // Initialize the application
        init();
    </script>
</body>
</html>
