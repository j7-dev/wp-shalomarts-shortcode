import bg from '@/assets/images/bg.png'
import { AbsImage, MapIcon } from '@/components'

function DefaultPage() {

	return (
		<div className="sh-flex">
			<div className="sh-w-[80%] sh-aspect-[1.814143] sh-bg-cover sh-bg-no-repeat sh-bg-center sh-relative" style={{
				backgroundImage: `url(${bg})`,
			}}>

				<AbsImage
					className='building1'
					width={28}
					top={65}
					left={17}
				/>

				<AbsImage
					className='building2'
					width={30}
					top={41}
					left={54}
				/>

				<AbsImage
					className='building3'
					width={29}
					top={42}
					left={74}
				/>


			</div>
			<div className="sh-flex-1 sh-bg-white"></div>




		</div>
	)
}

export default DefaultPage
