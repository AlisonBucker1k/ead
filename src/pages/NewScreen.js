import React from 'react';
import { SafeAreaView, Text } from 'react-native';
import { useNavigation, useRoute } from '@react-navigation/native'; 


const NewScreen = () => {
    const routes = useRoute();
    const name = routes.params.name;

    return(
        <SafeAreaView>
            <Text>Olá, {name} Essa é a nova tela</Text>
        </SafeAreaView>
    );
}

export default NewScreen;