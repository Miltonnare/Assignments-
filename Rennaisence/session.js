

const {MongoClient}=require('mongodb')

require ('dotenv').config()

const uri=process.env.MONGODB_URI

const client=new MongoClient(uri)

const sender_acc_id=1001
const receiver_acc_id=1005
const tran_amt=100

const accounts=client.db('bank').collection('accounts')

const session=client.startSession()

async function main(){
    try{
        let cursor=await accounts.find({account_id:{$in:[sender_acc_id,receiver_acc_id]}})
        for await (const doc of cursor) {
            console.log(doc)
        }

        await session.withTransaction(async()=>{
            await accounts.updateOne({account_id:sender_acc_id},{$inc:{balance:-tran_amt}})

            await accounts.updateOne({account_id:receiver_acc_id},{$inc:{balance:tran_amt}})
            console.log("Committing Transaction")
        })
        
        cursor=await accounts.find({account_id:{$in:[sender_acc_id,receiver_acc_id]}})
        for await(const doc of cursor){
            console.log(doc)
        }
    } catch(err){
        console.error(`Transaction aborted ${err}`)
    } finally{
        await session.endSession()
        await client.close()
    }
}

main()


// This code is meant to help unerstand the Session
