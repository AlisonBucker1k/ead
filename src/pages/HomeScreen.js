import { useNavigation } from '@react-navigation/native';
import React, { useState, useLayoutEffect } from 'react';
import { Button, SafeAreaView, Text, StyleSheet } from 'react-native';
import { TextInput } from 'react-native-gesture-handler';

const HomeScreen = () => {
    const navigation = useNavigation();

    const [ name, setName ] = useState('');
    const [count, setCount ] = useState(0);

    useLayoutEffect(()=>{
        navigation.setOptions({
            title:count
        });
    },[count])

    useLayoutEffect(()=>{
        navigation.setOptions({
            headerRight: () => <Button title="AAA" onPress={handleHeaderPlus}/>
        });
    },[])

    const handleHeaderPlus = () => {
        // setCount(count + 1);
        // setCount((c)=>{
        //     return c+1
        // });

        setCount( c => c + 1);
    }

    const handleSendButton = () => {

        navigation.setOptions({
            title:name
        });

        // navigation.navigate('Future', {
        //     name,
        //     cor:'purple'
        // });
    }
    return(
        <SafeAreaView style={style.container}>
            <Text>Qual é o seu nome?</Text>

            <TextInput 
                style={style.input} 
                value={name} 
                onChangeText={(t)=>setName(t)}/>

            <Button title="Enviar" onPress={handleSendButton}/>

            <Button title="Background Preto" onPress={()=>navigation.setOptions({
                headerStyle:{
                    backgroundColor: '#000',
                    height: 100
                }
            })}/>

            <Button title="+1" onPress={()=>setCount(count + 1)}/>
        </SafeAreaView>
    );
}

const style = StyleSheet.create({
    container:{
        flex:1,
        justifyContent: 'center',
        alignItems: 'center'
    },
    input:{
      width: 250,
      padding: 10,
      fontSize:15,
      backgroundColor:'#ddd',
      margin: 10
    }
});

export default HomeScreen;