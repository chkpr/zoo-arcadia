
        
        
     
        
        const { MongoClient } = require("mongodb");

        const uri = "mongodb+srv://chkipmemoire:Roebling11@cluster0.qbe0v.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0"

        const client = new MongoClient(uri);

        async function run() {
            try {
                const database = client.db('arcadia');
                const animals = database.collection('animals');

                //const query = { name: 'Simba' };
                //const animal = await animals.findOne(query);

                //console.log(animal);
                

                const filter = { name: 'Simba'};

                const updateDocument = {
                    $inc: {
                        views: 1,
                    }
                };

                const result = await animals.updateOne(filter, updateDocument);

            } finally {
                await client.close();
            }
        }
        run().catch(console.dir);

        
        