import { useNavigation, useRoute } from '@react-navigation/native'; 
import React from 'react';
import { View, Text, Button, StatusBar } from 'react-native';

export default (props) => {

    const navigation = useNavigation();
    const route = useRoute();

    const name = props.route.params.name;

    if(name == ''){
        navigation.navigate('Home');
        
    }

    const handleSendName = () => {
        navigation.navigate('New', {
            name
        });
    }

    return(
        <View>
            <StatusBar barStyle="light-content" backgroundColor={route.params.cor}/>
            <Text>Olá {name}</Text>
            <Button title="Mandar nome" onPress={handleSendName}/>
        </View>
    );
}