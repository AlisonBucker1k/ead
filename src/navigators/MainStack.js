import React from 'react';
import { Button, Text, Image } from 'react-native';
import { createStackNavigator } from '@react-navigation/stack';

import HomeScreen from '../pages/HomeScreen';
import FutureScreen from '../pages/FutureScreen';
import NewScreen from '../pages/NewScreen';
import { TextInput } from 'react-native-gesture-handler';

import Logo from '../components/Logo';

const MainStack = createStackNavigator();

export default () => {
    return(
        <MainStack.Navigator screenOptions={{
            headerTitleAlign:'center',
            headerStyle:{
                backgroundColor:'#ff6666',
                height:100
            },
            headerTitleStyle:{
                color: '#fff',
                fontSize:18
            },
            
        }}>
            <MainStack.Screen name="Home" component={HomeScreen} />
            <MainStack.Screen name="Future" component={FutureScreen} />
            <MainStack.Screen name="New" component={NewScreen} />
        </MainStack.Navigator>
    );
}