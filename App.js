import React from 'react';
import { Provider } from 'react-redux';
import Store from './src/Store';
import { NavigationContainer } from '@react-navigation/native';
import MainStack from './src/navigators/MainStack';

const App = () => {
    return(
        <Provider store={Store}>
            <NavigationContainer>
                <MainStack />
            </NavigationContainer>
        </Provider>
    );
}

export default App;