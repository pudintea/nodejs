const response = (statusCode, message, res) => {
    res.status(statusCode).json({
        statusCode : statusCode,
        message : message
    })
}

module.exports = response