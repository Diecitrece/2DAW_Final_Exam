import Head from 'next/head'
import styles from '../styles/createReview.module.css'
import React, { useContext, useEffect, useState } from 'react';
import Link from 'next/link';
import { useRouter } from 'next/router'
import reviewConverter from '../components/reviewConverter';


export default function createReview() {
    const [sent, setSent] = useState(false);
    const [stars, setStars] = useState();
    const router = useRouter()
    const received = router.query;

    function updateStars(rating)
    {
        setStars(reviewConverter(rating));
    }

    const sendForm = async event => 
    {
        event.preventDefault();
        let restaurant_id = received.restaurant_id;
        let email = event.target.email.value;
        let punctuation = event.target.punctuation.value;
        let description = event.target.description.value;

        let url=process.env.apiRoute + '/reviews';
        // setLoading(true)
        let reviewData = 
        {
            "description" : description,
            "email": email,
            "punctuation": Number(punctuation),
            "restaurant_id": Number(restaurant_id),
        }
        const response = await fetch(url, 
        {
            method: "POST",
            body: JSON.stringify(reviewData),
            headers: 
            {
                'Content-Type':'application/json',
            },
            mode: 'no-cors',
        })
        //.then(response => response.json())
        .then(data =>
            {
                setSent(true);
                setInterval(() => {
                    window.location = '/restaurants';
                  }, 5000);
            })
        .catch(error => console.log(error));
        
    }
    if(!sent)
    {

        return (
        <div className='showBox'>
            <Head>
                <title>infoCastellón - Rate "{received.restaurant_name}"</title>
                <meta charSet="utf-8"></meta>
                <link rel="icon" href="/favicon.ico" />
            </Head>
            <div className='pageTitle'>
                Create a review for "{received.restaurant_name}"
            </div>
            <div className={styles.page} id='page'>
                <form onSubmit={sendForm} className={styles.form}>
                    <div className={styles.formData}>
                        <div className='w-full'>
                            <div className='w-full'>
                                <label htmlFor='email' className='block w-full'>Email:
                                    <input className={styles.input} id='email' name='email' type='email' autoComplete='name' required />
                                </label>
                            </div>
                            <div className='w-80'>
                                <label htmlFor='punctuation' className='block w-full justify-self-end'><span className='whitespace-nowrap'>Rate: {stars}</span><br/>
                                    <input className={styles.input} onChange={(e) => {updateStars(e.target.value)}} id='punctuation' name='punctuation' type='number' step="any" max='5' min='0' required/>
                                </label>
                            </div>
                        </div>

                        <label htmlFor='description'>Description:</label>
                        <textarea id="description" name='description' className={styles.textarea} required maxLength='250' rows='5'>
                        </textarea>

                        <button type='submit' className={styles.button}>Create review</button>
                    </div>
                </form>
            </div>
        </div>
        )
    }
    return(
        <div className='showBox'>
            <Head>
                <title>infoCastellón - Rate "{received.restaurant_name}"</title>
                <meta charSet="utf-8"></meta>
                <link rel="icon" href="/favicon.ico" />
            </Head>
            <div className='pageTitle'>
                Create a review for "{received.restaurant_name}"
            </div>
            <div className={styles.page} id='page'>
                <div className={styles.sent}>
                    ¡Reseña creada correctamente!<br/>
                    <div><i className="fas fa-spinner" id='spinner'></i>Se te redirigirá en unos instantes</div>
                </div>
            </div>
        </div>
    )
}
