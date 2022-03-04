import React from 'react'
import ReactDOM from 'react-dom';

function Header() {
  return (
    <div className='header'>
        asdsasads
      <div className='left'>Logo</div>
      <div className='right'>Links</div>
    </div>
  )
}

export default Header;
if (document.getElementById('header')) {
    ReactDOM.render(<Header />, document.getElementById('header'));
}