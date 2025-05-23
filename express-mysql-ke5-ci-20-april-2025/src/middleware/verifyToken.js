const jwt = require('jsonwebtoken');

const verifyToken = (req, res, next) => {
  const authHeader = req.headers['authorization'];
  if (!authHeader || !authHeader.startsWith('Bearer ')) {
    return res.status(401).json({ status:'gettoken', message: 'Aksess membutuhkan token' });
  }

  const token = authHeader.split(' ')[1];
  try {
    const decoded = jwt.verify(token, process.env.JWT_SECRET);
    req.user = decoded; // simpan data user dari token
    next();
  } catch (err) {
    // Cek jika error karena token expired
    if (err.name === 'TokenExpiredError') {
        return res.status(403).json({status:'expired', message: 'Token sudah kedaluwarsa' });
    }
  
      // Jika token rusak atau tidak valid
      return res.status(403).json({ status:'notvalid', message: 'Token tidak valid' });
  }
};

module.exports = verifyToken;
// ------- Pudintea
