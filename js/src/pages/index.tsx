import { useRef, useEffect, useState } from 'react'
import bg from '@/assets/images/bg.png'
import { AbsImage, ListDataItem, MapIcon, Card } from '@/components'
import { LIST_DATA, MAP_DATA, CARD_DATA } from '@/utils'

function DefaultPage() {
	const bgRef = useRef<HTMLDivElement>(null)
	const [height, setHeight] = useState('0rem')

	useEffect(() => {
		if (!bgRef.current) {
			setHeight('auto')
			return
		}

		setHeight(`${bgRef.current.clientHeight}px`)

	}, [bgRef])

	return (
		<div className="sh-flex sh-flex-col lg:sh-flex-row sh-gap-8 lg:sh-gap-0">
			<div className='sh-w-full sh-h-[500px] lg:sh-w-[80%] lg:sh-h-auto lg:sh-aspect-[1.814143] sh-overflow-x-auto sh-flex sh-items-end'>
				<div ref={bgRef} className="sh-w-[800px] sh-h-[441px] lg:sh-h-auto lg:sh-w-full sh-aspect-[1.814143] sh-bg-cover sh-bg-no-repeat sh-bg-center sh-relative" style={{
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

					{MAP_DATA.map(({ postId, top, left, building }) => (
						<MapIcon
							key={`${postId}${top}${left}`}
							building={building}
							postId={postId}
							top={top}
							left={left}
						/>
					))}


					{CARD_DATA.map((card) => (
						<Card
							key={card.postId}
							{...card}
						/>
					))}

				</div>
			</div>
			<div className="sh-w-full lg:sh-flex-1 sh-bg-white sh-p-0 sh-overflow-y-auto" style={{
				height,
			}}>
				{
					LIST_DATA.map((list) => (
						<ListDataItem
							key={list.postId}
							{...list} />
					))
				}
			</div>
		</div>
	)
}

export default DefaultPage
