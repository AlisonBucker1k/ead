import React from 'react';
import { Image } from 'react-native';

const Logo = () => {
    return(
        <Image style={{width: 150,height:50}} source={{uri: 'https://google.com/google.jpg'}}/>
    );
}

export default Logo;