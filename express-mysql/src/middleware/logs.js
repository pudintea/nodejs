const logRequest = (req, res, next) => {
    console.log('Terjadi riquest ke PATH : ', req.path);
    next();
}

module.exports = logRequest;